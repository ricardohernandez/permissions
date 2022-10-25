<template lang="">
    
    <Form 
        :roles_items="roles_items" 
        :permission_items="permission_items" 
        :rolespermissiondata="rolespermissiondata" 
        :errors="errors"/>

    <TableFilters :tbfilters="tbfilters" />

    <div class="px-1"> 
        <div class="flex flex-col">
            <div class="xs:h-64 sm:h-96 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-gray-300 dark:scrollbar-thumb-gray-700 dark:scrollbar-track-gray-500"><!-- h-96   -->
                <table class="w-full shadow-md  border-collapse   dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="py-1 px-2 border w-24 dark:border-0 text-xs font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                {{__('table_actions')}}
                            </th>

                            <th scope="col" class="py-1 px-2 border w-24 dark:border-0 text-xs font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                <span @click="sort('name')" class="order px-4 inline-flex w-full justify-between">
                                    {{__('role')}}
                                    <svg v-if="params.fieldh==='name' && params.directionh==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                    <svg v-if="params.fieldh==='name' && params.directionh==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                </span>
                            </th>

                            <th scope="col" class="py-1 px-2 border  dark:border-0 text-xs font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                {{__('permissions')}}
                            </th>

                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        <tr v-for="roleh , index in roleshaspermissions.data" :key="roleh.id"  @click="selectRow(roleh.id)" :class="{'bg-gray-200 dark:bg-slate-900 ': (roleh.id == selectedRow)}" class="hover:bg-gray-300 dark:hover:bg-slate-900">
                            <td class="py-1 px-2 border  dark:border-0 text-xs  font-medium text-left whitespace-nowrap">
                               <!--  <button class="font-medium ml-1 text-blue-600 dark:text-slate-300 hover:underline" :title="__('edit')"
                                    @click="edit(roleh)" >
                                    <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button> -->

                                <button class="font-medium ml-1 text-blue-600 dark:text-slate-300 hover:underline" :title="__('edit')"
                                    @click="showModalPermissions(roleh)" >
                                    <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </button>

                                <!-- <button class="ml-1 font-medium text-red-600 dark:red-blue-500 hover:underline" :title="__('delete')"
                                    @click="showConfirmDeleteModal(roleh.id)" >
                                    <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button> -->
                            </td> 

                            <td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <span :title="roleh.name">{{ $filters.truncate(roleh.name) }} </span>
                            </td>
                            
                            <td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <span v-if="roleh.permissions.length"> 
                                    <span v-for="permission in roleh.permissions"> 
                                        {{ permission.name }} -  
                                    </span>
                                </span>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="invisible md:visible grid xs:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mt-4 dark:text-gray-400 dark:border-gray-900">
                <div class="col-span-1">
                    <tableInfo :from="$page.props.roleshaspermissions.from" :to="$page.props.roleshaspermissions.to" :total="$page.props.roleshaspermissions.total" />
                </div>
                <div class="col-span-1"> 
                    <pagination :links="roleshaspermissions.links"/>
                </div>
            </div>
        </div>
    </div>

    <modal-delete
        :isConfirmDeleteModalVisible="isConfirmDeleteModalVisible"
        :id = "id_delete"
        :title="__('permissions')"
        @deleteRecordEvent="deleteRecord"
        @close="closeConfirmDeleteModal"/>
    
    <modal-permissions 
        :isModalPermissionsVisible="isModalPermissionsVisible"
        :roledata = "roledata"
        :permissions = "permissions"
        :errors="errors"
        @close="closeModalDetailsModal" /> 
        
</template>
<script>    
    import { defineComponent } from 'vue'
    import Form from './Form.vue'
    import TableFilters from './TableFilters.vue'
    import Pagination from 'Shared/Pagination.vue'
    import TableInfo from 'Shared/TableInfo.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetBtnLink from '@/Jetstream/BtnLink.vue'
    import ModalDelete from 'Shared/Modals/ModalDelete.vue'
    import ModalPermissions from './ModalPermissions.vue'
    import { Link } from '@inertiajs/inertia-vue3'
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'

    export default defineComponent({
        components: {
            Pagination,TableInfo,ModalDelete,ModalPermissions,Form,TableFilters, JetNavLink,JetBtnLink,Link,
        },
        props: {
            roleshaspermissions: Object,
            roles_items: Array,
            permission_items: Array,
            errors: Object,
            tbfilters: Object,
        },
        data(){
            return {
                selectedRow : null,
                isConfirmDeleteModalVisible : false,
                id_delete : "",
                isModalPermissionsVisible : false,
                roledata : "",
                permissions : [],
                rolespermissiondata: {
                    rolesitems : "",
                    permissionsitems : []
                },
                params : {
                    fieldh :  this.tbfilters.fieldh,
                    directionh :  this.tbfilters.directionh,
                }
            }
        },
        methods : {
     
            edit: function (row) {
                this.rolespermissiondata.rolesitems = row.id

                var arr = [];
                var len = row.permissions.length;
                for (var i = 0; i < len; i++) {
                    arr.push({
                        value: row.permissions[i].name,
                        label: row.permissions[i].name,
                    });
                }
                this.rolespermissiondata.permissionsitems = arr
               
            },
            selectRow(role){
                this.selectedRow = role;
            },
            sort(field){
                this.params.fieldh = field;
                this.params.directionh = this.params.directionh  === 'asc' ? 'desc' : 'asc'
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
                this.$inertia.delete(this.route('permissions_asignation.destroy',id))
                this.id_delete = ""
            },
            showModalPermissions(role){
                this.permissions = [],
                axios.get(this.route('getRolePermissions'),
                    {
                        params: {
                            id : role.id
                        }
                    }
                ).then((response) => {
                    this.isModalPermissionsVisible = true;
                    this.permissions = response.data
                    this.roledata = role 
                })
            },
            closeModalDetailsModal() {
                this.isModalPermissionsVisible = false;
                this.roledata = ""
            },

        },
        watch: {
            params : {
                handler : debounce(function(){
                    let params = pickBy(this.params)
                    this.$inertia.get(this.route('permissions_asignation') , params , {
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