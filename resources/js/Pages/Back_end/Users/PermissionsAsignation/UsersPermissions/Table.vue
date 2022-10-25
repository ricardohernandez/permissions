<template lang="">
    
    <Form 
        :users_items="users_items" 
        :permission_items="permission_items" 
        :userspermissiondata="userspermissiondata" 
        :errors="errors"/>
    
    <TableFilters :tbfilters="tbfilters" />

    <div class="px-1"> 
        <div class="flex flex-col">
            <div class="xs:h-64 sm:h-96 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-gray-300 dark:scrollbar-thumb-gray-700 dark:scrollbar-track-gray-500">
                <table class="w-full shadow-md  border-collapse   dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="py-1 px-2 border w-12 dark:border-0 text-xs font-semibold text-left whitespace-nowrap uppercase text-gray-900  dark:text-gray-200">
                                {{__('table_actions')}}
                            </th>

                            <th scope="col" class="py-1 px-2 border w-36 dark:border-0 text-xs font-semibold text-left whitespace-nowrap uppercase text-gray-900  dark:text-gray-200">
                                <span @click="sort('name')" class="order px-4 inline-flex w-full justify-between">
                                    {{__('user_name')}}
                                    <svg v-if="params.fieldus==='name' && params.directionus==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                    <svg v-if="params.fieldus==='name' && params.directionus==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                </span>
                            </th>

                            <th scope="col" class="py-1 px-2 border w-12 dark:border-0 text-xs font-semibold text-left whitespace-nowrap uppercase text-gray-900  dark:text-gray-200">
                                {{__('role')}}
                            </th>
                            
                            <th scope="col" class="py-1 px-2 border  dark:border-0 text-xs font-semibold text-left whitespace-nowrap uppercase text-gray-900  dark:text-gray-200">
                                {{__('permissions_user_title')}}
                            </th>

                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        <tr v-for="user , index in users.data" :key="user.id"  @click="selectRow(user.id)" :class="{'bg-gray-200 dark:bg-slate-900 ': (user.id == selectedRow)}" class="hover:bg-gray-300 dark:hover:bg-slate-900">
                            <td class="py-1 px-2 border  dark:border-0 text-xs  font-medium text-left whitespace-nowrap">
                              <!--   <button class="font-medium ml-1 text-blue-600 dark:text-slate-300 hover:underline" :title="__('edit')"
                                    @click="edit(user)" >
                                    <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button> -->

                                <button class="font-medium ml-1 text-blue-600 dark:text-slate-300 hover:underline" :title="__('edit')"
                                    @click="showModalPermissions(user)" >
                                    <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </button>

                               <!--  <button class="ml-1 font-medium text-red-600 dark:red-blue-500 hover:underline" :title="__('delete')"
                                    @click="showConfirmDeleteModal(user.id)" >
                                    <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button> -->
                            </td> 

                            <td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <span :title="user.name">{{ $filters.truncate(user.name) }} </span>
                            </td>

                            <td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <span v-if="user.roles.length"> 
                                   {{ user.roles[0].name }} 
                                </span>
                            </td>
                            
                            <td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <span v-if="user.permissions.length"> 
                                    <span v-for="p in user.permissions"> 
                                        {{ p.name }} -  
                                    </span>
                                </span>
                            </td>

                            <!--<td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <span v-if="user.permission.length"> 
                                    <span v-for="p in user.permission"> 
                                        {{ p.name }} -  
                                    </span>
                                </span>
                            </td>-->


                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="invisible md:visible grid xs:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 mt-4 dark:text-gray-400 dark:border-gray-900">
                <div class="col-span-1">
                    <tableInfo :from="$page.props.users.from" :to="$page.props.users.to" :total="$page.props.users.total" />
                </div>
                <div class="col-span-1"> 
                    <pagination :links="users.links"/>
                </div>
            </div>
        </div>
    </div>

      
    <modal-permissions 
        :isModalPermissionsVisible="isModalPermissionsVisible"
        :userdata = "userdata"
        :permissions = "permissions"
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
    import Form from './Form.vue'
    import TableFilters from './TableFilters.vue'
    import ModalDelete from 'Shared/Modals/ModalDelete.vue'
    import ModalPermissions from './ModalPermissions.vue'
    import Pagination from 'Shared/Pagination.vue'
    import TableInfo from 'Shared/TableInfo.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetBtnLink from '@/Jetstream/BtnLink.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import { throttle } from 'lodash'
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'
                                             
    export default defineComponent({
        components: {
            Pagination,TableInfo,ModalDelete,ModalPermissions,Form,TableFilters,JetNavLink,JetBtnLink,Link
        },
        props: {
            users: Object,
            users_items: Array,
            permission_items: Array,
            tbfilters: Object,
            errors: Object,
        },
        data(){
            return {
                selectedRow : null,
                isConfirmDeleteModalVisible : false,
                isModalPermissionsVisible : false,
                permissions : [],
                userdata : "",
                id_delete : "",
                userspermissiondata: {
                    useritems : [],
                    permissionsitems : []
                },
                params : {
                    fieldus :  this.tbfilters.fieldus,
                    directionus :  this.tbfilters.directionus,
                }
            }
        },
        methods : {
            edit: function (row) {
                
                var arr_user = [];
                arr_user.push({
                    value: row.id,
                    label: row.name,
                });

                this.userspermissiondata.useritems = arr_user

                var arr = [];
                var len = row.permissions.length;
                for (var i = 0; i < len; i++) {
                    arr.push({
                        value: row.permissions[i].name,
                        label: row.permissions[i].name,
                    });
                }
                
                this.userspermissiondata.permissionsitems = arr
                
            },
            selectRow(role){
                this.selectedRow = role;
            },
            sort(field){
                this.params.fieldus = field;
                this.params.directionus = this.params.directionus  === 'asc' ? 'desc' : 'asc'
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
                this.$inertia.delete(this.route('users_permissions.destroy',id))
                this.id_delete = ""
            },
            showModalPermissions(user){
                this.permissions = [],
                axios.get(this.route('getUserPermissions'),
                    {
                        params: {
                            id : user.id
                        }
                    }
                ).then((response) => {
                    console.log(response.data)
                    this.isModalPermissionsVisible = true;
                    this.permissions = response.data
                    this.userdata = user 
                })
            },
            closeModalPermissionsModal() {
                this.isModalPermissionsVisible = false;
                this.userdata = ""
            },

        },
        watch: {
            params : {
                handler : debounce(function(){
                    let params = pickBy(this.params)
                    this.$inertia.get(this.route('users_permissions') , params , {
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