<template>
   
    <show-content :show="isModalVisible" @close="closeModal" maxWidth="2xl">
        <template #title>
            <div class="flex justify-between items-start py-2 px-6 rounded-t border-b dark:border-gray-600">
                <h3 class="text-lg mt-2 font-semibold text-gray-900 dark:text-white">
                     {{ getTitle }} 
                </h3>
                <button type="button" @click="closeModal"  class="mt-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>
        </template>

        <template #content>
            <div class="px-2 py-1">
                <div class="w-6xl py-2 px-2 lg:px-2">
                    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                        <div class="flex flex-col">
                        <div class="h-128 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-gray-300 dark:scrollbar-thumb-gray-700 dark:scrollbar-track-gray-500">       
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('table_name')}}
                                    </th>

                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('table_email')}}
                                    </th>

                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('table_phone')}} 
                                    </th>

                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('role')}}
                                    </th>

                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('leader')}}
                                    </th>

                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('status')}}
                                    </th>

                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('table_date')}}
                                    </th>

                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('table_created_at')}}
                                    </th>

                                    <th scope="col" class="py-1 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-semibold text-left uppercase text-gray-900  dark:text-gray-200">
                                        {{__('table_updated_at')}}
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                <tr v-for="user in modal_data" :key="user.id"  @click="selectRow(user.id)" :class="{'bg-gray-200 dark:bg-slate-900 ': (user.id == selectedUser)}" class="hover:bg-gray-300 dark:hover:bg-slate-900">
                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400">
                                        <span :title="user.name">{{ $filters.truncate(user.name) }} </span>
                                    </td>
                                            
                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400">{{ user.email }}</td>
                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400">{{ user.phone }}</td>
                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400">
                                        <span v-if="user.roles.length"> 
                                            {{ user.roles[0].name }} 
                                        </span>
                                    </td>

                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400"> 
                                        <span v-if="user.leader!=null"> 
                                            {{ user.leader.user.name }}
                                        </span>
                                    </td>

                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400"> {{ user.status }}  </td>
                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400"> {{ user.date_admission }}  </td>
                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400"> {{ user.created_at }}  </td>
                                    <td class="py-0.5 px-2 whitespace-nowrap border  dark:border-0 xs:text-sm sm:text-xs  font-medium  text-gray-500  dark:text-gray-400"> {{ user.updated_at }}  </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-row justify-end px-6 py-4 bg-gray-100  dark:border-white dark:text-white  dark:bg-slate-800 text-right">
                <div class="flex justify-center ">
                    <div class="basis-1/6">
                        <BlueButton size="md" type="submit" :title="__('download')">
                            <svg class="mr-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        </BlueButton>
                    </div>
                    <div class="basis-1/6">
                        <BlackButton size="md" @click="closeModal"  class="ml-5" :title="__('close')">
                        <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </BlackButton>
                    </div>
                </div>
            </div>
        </template>
    </show-content>
</template>

<script>
    import { defineComponent } from 'vue'
    import { v4 as uuid } from 'uuid'
    import ShowContent from 'Shared/Modals/ShowContent.vue'
    import BlackButton from 'Shared/Buttons/BlackButton.vue'
    import BlueButton from 'Shared/Buttons/BlueButton.vue'

    export default defineComponent({
        components: {
            BlackButton,BlueButton,ShowContent
        }, 
        props: {
            id: {
                type: String,
                default() {
                    return `text-input-${uuid()}`
                },
            },
            isModalVisible: {
                type: Boolean,
                default: false
            },
            modal_data: {
                required: true,
                type: Array,
            },
        },
        computed : {
            getTitle(){
                const active = this.modal_data["info"].label=="1" ? this.__('active') : this.__('no_active');
                const date = this.modal_data["info"].x
                const count = this.modal_data["info"].y
                return `${count} ${this.__('users_title')} ${active} ${this.__('with_date')} ${date}` 
            }
        },
        data(){
            return {
                 selectedUser : null,
            }
        },
        methods : {
            closeModal() {
                this.$emit("close");
            },
            selectRow(user){
                this.selectedUser = user;
            },

        },
   })

</script>