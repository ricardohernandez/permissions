<template lang="">
    <div>
        <!-- TABLE-->   
        <div class="rounded-2xl flex-col dark:bg-slate-900/70 bg-gray-200 flex">
            <div class="flex flex-col">
                <div class="h-128 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-gray-300 dark:scrollbar-thumb-gray-700 dark:scrollbar-track-gray-500">
                    <table class="w-full shadow-md  border-collapse   dark:divide-gray-700">
                        <thead class="">
                            <tr>
                                <th scope="col" class="py-2 px-2 whitespace-nowrap   xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    {{__('table_actions')}}
                                </th>

                                <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    <span @click="sort('name')" class="order px-4 inline-flex w-full justify-between">
                                        {{__('table_name')}}
                                        <svg v-if="params.field==='name' && params.direction==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                        <svg v-if="params.field==='name' && params.direction==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                    </span>
                                </th>

                                <!--  <th scope="col" class="py-1 px-2 whitespace-nowrap  xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    {{__('table_photo')}} 
                                </th> -->

                                <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    <span @click="sort('email')" class="order px-4 inline-flex w-full justify-between">
                                        {{__('table_email')}}
                                        <svg v-if="params.field==='email' && params.direction==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                        <svg v-if="params.field==='email' && params.direction==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                    </span>
                                </th>

                                <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    {{__('table_phone')}} 
                                </th>

                                <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    {{__('role')}}
                                </th>

                                <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    {{__('leader')}}
                                </th>

                                 <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    {{__('status')}}
                                </th>

                                <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    <span @click="sort('date_admission')" class="order px-4 inline-flex w-full justify-between">
                                        {{__('table_date')}}
                                        <svg v-if="params.field==='date_admission' && params.direction==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                        <svg v-if="params.field==='date_admission' && params.direction==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                    </span>
                                </th>

                                <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    <span @click="sort('created_at')" class="order px-4 inline-flex w-full justify-between">
                                        {{__('table_created_at')}}
                                        <svg v-if="params.field==='created_at' && params.direction==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                        <svg v-if="params.field==='created_at' && params.direction==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                    </span>
                                </th>

                                <th scope="col" class="py-2 px-2 whitespace-nowrap    xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-white">
                                    <span @click="sort('updated_at')" class="order px-4 inline-flex w-full justify-between">
                                        {{__('table_updated_at')}}
                                        <svg v-if="params.field==='updated_at' && params.direction==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                        <svg v-if="params.field==='updated_at' && params.direction==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                    </span>
                                </th>

                            </tr>
                        </thead>
                        
                        <tbody class=""><!-- bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700 -->
                            <tr v-for="user , index in users.data" :key="user.id"  @click="selectRow(user.id)" :class="{'bg-gray-200 dark:bg-slate-700 ': (user.id == selectedUser) , 'bg-gray-100 dark:bg-slate-800' : (index % 2  == 0)}" class="hover:bg-gray-200 dark:hover:bg-slate-700">
                                <td class="xs:py-1.5 sm:py-1.5  px-2 whitespace-nowrap    xs:text-sm sm:text-xs   font-medium text-left ">
                                   
                                    <Link v-if="$can('users_editor.edit')" preserve-scroll
                                        :href="route('users.edit', user.id)" class="font-medium ml-1 text-blue-600 dark:text-slate-300 hover:underline">
                                        <svg class="inline-block xs:w-6 xs:h-6 sm:w-5 sm:h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </Link>

                                    <Link v-if="$can('users_editor.show')" preserve-scroll
                                        :href="route('users.show', user.id)" class="font-medium ml-1 text-blue-600 dark:text-slate-300 hover:underline">
                                        <svg class="inline-block xs:w-6 xs:h-6 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                                    </Link>

                                    <button v-if="$can('users_editor.delete')" class="ml-1 font-medium text-red-600 dark:red-blue-500 hover:underline"
                                        @click="showConfirmDeleteModal(user.id)" >
                                        <svg class="inline-block xs:w-6 xs:h-6 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>

                                    <button v-if="$can('users_editor.send')" :disabled="indexSendMail==index"  @click="sendEmail(user.id, index)" class="ml-1 font-medium text-blue-600 dark:text-slate-300 hover:underline">
                                        <svg  v-if="indexSendMail==index" role="status" class="inline-block xs:w-6 xs:h-6 sm:w-5 sm:h-5 mr-1 text-gray-100 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>  

                                        <span  v-else> <svg class="inline-block xs:w-6 xs:h-6 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg></span>
                                    </button>

                                </td> 

                                <td class="py-1 px-2 whitespace-nowrap  dark:border-l-slate-700   xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300">
                                    <span :title="user.name">{{ $filters.truncate(user.name) }} </span>
                                </td>
            
                               <!--  <td class="py-1 px-2 whitespace-nowrap  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300">
                                    <a v-if="user.profile_photo_path!=null" target="_blank" :href="`/storage/${user.profile_photo_path}`">
                                        <img :src="`/storage/${user.profile_photo_path}`" class="w-6 h-6 rounded-full">
                                    </a>
                                </td> -->

                                <td class="py-1 px-2 whitespace-nowrap   dark:border-l-slate-700  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300">{{ user.email }}</td>
                                <td class="py-1 px-2 whitespace-nowrap   dark:border-l-slate-700  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300">{{ user.phone }}</td>
                                <td class="py-1 px-2 whitespace-nowrap   dark:border-l-slate-700  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300">
                                    <span v-if="user.roles.length"> 
                                        {{ user.roles[0].name }} 
                                    </span>
                                </td>

                                <td class="py-1 px-2 whitespace-nowrap   dark:border-l-slate-700  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300"> 
                                    <span v-if="user.leader!=null"> 
                                        {{ user.leader.user.name }}
                                    </span>
                                </td>

                                <!--<td class="py-1 px-2 whitespace-nowrap  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300">
                                    <span v-if="user.permission.length"> 
                                        <span v-for="permission in user.permission "> 
                                            {{ permission.name }} -  
                                        </span>
                                    </span>
                                </td>-->
                                
                                <td class="py-1 px-2 whitespace-nowrap   dark:border-l-slate-700  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300"> {{ user.status }}  </td>
                                <td class="py-1 px-2 whitespace-nowrap   dark:border-l-slate-700  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300"> {{ user.date_admission }}  </td>
                                <td class="py-1 px-2 whitespace-nowrap   dark:border-l-slate-700  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300"> {{ user.created_at }}  </td>
                                <td class="py-1 px-2 whitespace-nowrap   dark:border-l-slate-700  xs:text-sm sm:text-xs  font-medium  text-gray-900  dark:text-gray-300"> {{ user.updated_at }}  </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-2 lg:px-6 border-t border-gray-100 dark:border-slate-800">
                    <div class="grid xs:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2 dark:text-gray-300 dark:border-gray-900">
                        <div class="text-xs md:text-base lg:col-span-1">
                            <tableInfo :from="$page.props.users.from" :to="$page.props.users.to" :total="$page.props.users.total" />
                        </div>
                         <div class="text-sm md:text-base lg:col-span-1"> 
                            <pagination  :links="users.links"/>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <modal-delete
            :isConfirmDeleteModalVisible="isConfirmDeleteModalVisible"
            :id = "id_delete"
            @deleteRecordEvent="deleteRecord"
            @close="closeConfirmDeleteModal"/>
     
    </div>
   
</template>
<script>    
    import { defineComponent } from 'vue'
    import TableFilters from './TableFilters.vue'
    import ModalDelete from 'Shared/Modals/ModalDelete.vue'
    import Pagination from 'Shared/Pagination.vue'
    import tableInfo from 'Shared/TableInfo.vue'
    import JetNavLink from '@/Jetstream/NavLink.vue'
    import JetBtnLink from '@/Jetstream/BtnLink.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import { Inertia } from '@inertiajs/inertia';
    import { throttle } from 'lodash'
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'
                        

    export default defineComponent({
        components: {
            Pagination,tableInfo,ModalDelete,TableFilters,JetNavLink,JetBtnLink,Link,
        },
        props: {
            users: Object,
            tbfilters: Object,
            initialvalues: Object,
            roles: Object,
        },
        data(){
            return {
                selectedUser : null,
                indexSendMail :"a",
                isConfirmDeleteModalVisible : false,
                id_delete : "",
                params : {
                    field :  this.tbfilters.field,
                    direction :  this.tbfilters.direction,
                }
            }
        },
        methods : {
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
                this.$inertia.delete(this.route('users.destroy',id))
                this.id_delete = ""
            },

            selectRow(user){
              
                if(this.selectedUser!=user){
                    this.selectedUser = user;
                }
                
                console.log(this.selectedUser)
                console.log(user)

               /*  this.selectedUser = user; */
            },
            sort(field){
                this.params.field = field;
                this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc'
            },
            sendEmail(id ,index){
                this.indexSendMail=index;
                /* this.users.data.splice(index, 1) */
                axios.get(this.route('sendEmail', {"id" : id}))
                .then(res => {
                    const data = res.data
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    })
                    this.indexSendMail = "a"
                })
            }
        },
        watch: {
            params : {
                handler : debounce(function(){
                    let params = pickBy(this.params)
                    this.$inertia.get(this.route('users') , params , {
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

    @media (min-width: 1024px){
        td:not(:first-child) {
            border-left-width: 1px;
        }
    }
</style>