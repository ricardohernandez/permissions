<template lang="">
    <div>
        <!-- TABLE-->   
        <div class="my-1 mx-2">
            <div class="flex flex-col">
                <div class="h-128 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-gray-300 dark:scrollbar-thumb-gray-700 dark:scrollbar-track-gray-500">
                    <table class="w-full shadow-md  border-collapse   dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="py-1 px-2  text-xs font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                    {{__('table_actions')}}
                                </th>

                                <th scope="col" class="py-1 px-2 border  dark:border-0 text-xs font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                    <span @click="sort('name')" class="order px-4 inline-flex w-full justify-between">
                                        {{__('table_name')}}
                                        <svg v-if="params.field==='name' && params.direction==='asc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                                        <svg v-if="params.field==='name' && params.direction==='desc'" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path></svg>
                                    </span>
                                </th>

                            </tr>
                        </thead>
                        
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            <tr v-for="leader , index in leaders.data" :key="leader.id"  @click="selectRow(leader.id)" :class="{'bg-gray-200 dark:bg-slate-900 ': (leader.id == selectedRow)}" class="hover:bg-gray-300 dark:hover:bg-slate-900">
                                <td class="py-1 px-2 border  dark:border-0 text-xs  font-medium text-left whitespace-nowrap">
                                   
                                    <Link v-if="$can('leaders.edit')" preserve-scroll
                                        :href="route('leaders.edit', leader.id)" class="font-medium ml-1 text-blue-600 dark:text-slate-300 hover:underline">
                                        <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </Link>

                                    <button v-if="$can('leaders.delete')" class="ml-1 font-medium text-red-600 dark:red-blue-500 hover:underline"
                                        @click="showConfirmDeleteModal(leader.id)" >
                                        <svg class="inline-block w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>

                                </td> 

                                <td class="py-1 px-2 border  dark:border-0 text-xs font-medium  text-gray-500 whitespace-nowrap dark:text-gray-400">
                                    <span :title="user.name">{{ $filters.truncate(leader.name) }} </span>
                                </td>
                              
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="grid xs:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mt-4 dark:text-gray-400 dark:border-gray-900">
                    <div class="text-xs md:text-base lg:col-span-2">
                        <tableInfo :from="$page.props.leaders.from" :to="$page.props.leaders.to" :total="$page.props.leaders.total" />
                    </div>
                    <div class="text-sm md:text-base lg:col-span-1"> 
                        <pagination  :links="leaders.links"/>
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
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'
      
    export default defineComponent({
        components: {
            Pagination,tableInfo,ModalDelete,TableFilters,JetNavLink,JetBtnLink,Link,
        },
        props: {
            leaders: Object,
            tbfilters: Object,
        },
        data(){
            return {
                selectedRow : null,
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
                this.$inertia.delete(this.route('leaders.destroy',id))
                this.id_delete = ""
            },
            selectRow(row){
                this.selectedRow = row;
            },
            sort(field){
                this.params.field = field;
                this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc'
            },
            
        },
        watch: {
            params : {
                handler : debounce(function(){
                    let params = pickBy(this.params)
                    this.$inertia.get(this.route('leaders') , params , {
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