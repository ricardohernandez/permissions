<template lang="">
    <PermissionsForm v-if="$can('permissions.create')"
        :modulesItems="modulesItems"  
        :permissionsOptions="permissionsOptions"  
        :errors="errors" />

    <PermissionsTableFilters :tbfilters="tbfilters" />

    <!-- TABLE-->   
        <div class="px-1"> 
            <div class="flex flex-col">
                <div class="h-96 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-gray-300 dark:scrollbar-thumb-gray-700 dark:scrollbar-track-gray-500">
                    <table class="w-full shadow-md border-collapse dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="py-1 px-2 border w-10 dark:border-0 text-xs font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                    {{__('table_actions')}}
                                </th>

                                 <th scope="col" class="py-1 px-2 border w-10  dark:border-0 text-xs font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                    <span @click="sort('name')" class="order px-4 inline-flex w-full justify-between">
                                        {{__('module')}}
                                        <svg v-if="params.fieldp==='name' && params.directionp==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                        <svg v-if="params.fieldp==='name' && params.directionp==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                    </span>
                                </th>
                                
                                <th scope="col" class="py-1 px-2 border  w-30 dark:border-0 text-xs font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                   {{__('permissions')}}
                                </th>

                            </tr>
                        </thead>
                        
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="permission , index in modules_permissions.data" :key="permission.id"  @click="selectRow(permission.id)" :class="{'bg-gray-200 dark:bg-slate-900 ': (permission.id == selectedRow)}" class="hover:bg-gray-300 dark:hover:bg-slate-900">
                                <td class="py-1 px-2 border  dark:border-0 text-xs  font-medium text-left whitespace-nowrap">
                                    
                                    <button v-if="$can('permissions.index')" class="font-medium ml-1 text-blue-600 dark:text-slate-300 hover:underline" :title="__('edit')"
                                        @click="showModalPermissions(permission)" >
                                        <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </button>

                                </td> 

                                <td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                   {{ permission.name }} 
                                </td>

                                <td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <span v-if="permission.permissions.length"> 
                                        <span v-for="p in permission.permissions"> 
                                            {{ p.name.split(".")[1] }} -  
                                        </span>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="grid xs:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-2 mt-4 dark:text-gray-400 dark:border-gray-900">
                    <div class="col-span-1"> 
                        <pagination :links="modules_permissions.links"/>
                    </div>
                    <div class="col-span-1">
                        <tableInfo :from="$page.props.modules_permissions.from" :to="$page.props.modules_permissions.to" :total="$page.props.modules_permissions.total" />
                    </div>
                   
                </div>
            </div>
        </div>
        
        <modal-permissions 
            :isModalPermissionsVisible="isModalPermissionsVisible"
            :module_data="module_data"
            :permissionsOptions="permissionsOptions"
            :errors="errors"
            @close="closeModalPermissionsModal" /> 
            
        <modal-delete
            :isConfirmDeleteModalVisible="isConfirmDeleteModalVisible"
            :id = "id_delete"
            @deleteRecordEvent="deleteRecord"
            @close="closeConfirmDeleteModal"/>
   
</template>
<script>    
    import { defineComponent } from 'vue'
    import PermissionsForm from './PermissionsForm.vue'
    import PermissionsTableFilters from './PermissionsTableFilters.vue'
    import ModalDelete from 'Shared/Modals/ModalDelete.vue'
    import ModalPermissions from './ModalPermissions.vue'
    import Pagination from 'Shared/Pagination.vue'
    import TableInfo from 'Shared/TableInfo.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetBtnLink from '@/Jetstream/BtnLink.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import { Inertia } from '@inertiajs/inertia';
    import { throttle } from 'lodash'
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'
                        
    export default defineComponent({
        components: {
            Pagination,TableInfo,ModalDelete,ModalPermissions,PermissionsForm,PermissionsTableFilters, JetNavLink,JetBtnLink,Link,
        },
        props: {
            tbfilters: Object,
            modules_permissions: Object,
            permissionsOptions: Object,
            modulesItems: Object,
            errors: Object,
        },
        data(){
            return {
                selectedRow : null,
                isConfirmDeleteModalVisible : false,
                isModalPermissionsVisible : false,
                permissions_options : null,
                module_data : null,
                id_delete : "",
                params : {
                    fieldp :  this.tbfilters.fieldp,
                    directionp :  this.tbfilters.directionp,
                }
            }
        },
        methods : {
            selectRow(permission){
                this.selectedRow = permission;
            },
            sort(field){
                this.params.fieldp = field;
                this.params.directionp = this.params.directionp === 'asc' ? 'desc' : 'asc'
            },
            showConfirmDeleteModal(id){
                this.isConfirmDeleteModalVisible = true;
                this.id_delete = id 
            },
            closeConfirmDeleteModal() {
                this.isConfirmDeleteModalVisible = false;
                this.id_delete = ""
            },
            deleteRecord(id) {
                this.isConfirmDeleteModalVisible = false;
                this.$inertia.delete(this.route('permissions.destroy',id))
                this.id_delete = ""
            },
            showModalPermissions(module_data){
                this.module_data = module_data 
                this.isModalPermissionsVisible = true;
            },
            closeModalPermissionsModal() {
                this.isModalPermissionsVisible = false;
            },   
        },
        watch: {
            params : {
                handler : debounce(function(){
                    let params = pickBy(this.params)
                    this.$inertia.get(this.route('roles_permissions') , params , {
                        replace : true , preserveState : true
                    })
                },550),
                deep : true
            }
        },   
    })

</script>
<style scope>
    .order{
        cursor:pointer;
    }
    .swal-wide{
        width:850px !important;
    }
    .highlight {
        /* background-color: #374151!important; */
         background-color: red!important;
        /* color:#fff!important; */
    }
    tr:hover{
        cursor: pointer;
    }
</style>