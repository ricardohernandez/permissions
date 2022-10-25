<template>
   
    <show-content :show="isModalPermissionsVisible" @close="closeModal">
        <template #title>

            <div class="flex justify-between items-start py-2 px-6 rounded-t border-b dark:border-gray-600">
                <h3 class="text-lg mt-2 font-semibold text-gray-900 dark:text-white">
                    {{ __("list_of_permissions_title") }} "{{ userdata.name}}"
                </h3>
                <button type="button" @click="closeModal"  class="mt-2 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="defaultModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                </button>
            </div>

        </template>

        <template #content>
            <form @submit.prevent="submit">
     
                <div class="px-2 py-1">
                    <div v-if="$page.props.errors.permissions" class="flex p-2 mb-2 bg-red-100 border-t-4 border-red-500 dark:bg-red-200" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium text-red-700">
                            {{ $page.props.errors.permissions }}
                        </div>
                        <button @click="toggle = !toggle" type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 dark:bg-red-200 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 dark:hover:bg-red-300 inline-flex h-8 w-8">
                            <span class="sr-only">Dismiss</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                
                    <div class="w-6xl py-2 px-2 lg:px-2">
                        <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="p-1">
                                            <div class="flex items-center">
                                                <input type="checkbox" 
                                                @click='checkAll()' 
                                                v-model='isCheckAll'
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            {{ __("permissions") }}
                                        </th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="permission in permissions" :key="permission.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="w-16 p-1">
                                            <div class="flex items-center">
                                            
                                            <input   
                                                :id="id" 
                                                v-model="permissions_values" 
                                                :value="permission.id"
                                                type="checkbox" 
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-1" class="sr-only">checkbox</label>

                                            </div>
                                        </td>
                                        <th scope="row" class="px-2 py-1 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            {{ permission.name }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row justify-end px-6 py-4 bg-gray-100  dark:border-white dark:text-white  dark:bg-slate-800 text-right">
                    <div class="flex justify-center ">
                        <div class="basis-1/6">
                            <BlueButton size="md" type="submit" :loading="form.processing" :title="__('update')">
                                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>         
                            </BlueButton>
                        </div>
                        <div class="basis-1/6">
                            <BlackButton size="md" @click="closeModal"  class="ml-5" :title="__('close')">
                            <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </BlackButton>
                        </div>
                    </div>
                </div>
            </form>
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
            isModalPermissionsVisible: {
                type: Boolean,
                default: false
            },
            userdata: {
                required: true,
            },
            permissions: {
                required: true,
            },
            errors: Object,
            modelValue: String,
        },
        emits: ['update:modelValue'],
        data(){
            return {
                permissions_values : null,
                form : "",
                isCheckAll : false
            }
        },
        watch: {
            userdata: {
                handler(user){
                    if(user.id!=""){
                        const array = []
                        this.permissions.map(function(value, key) {
                            if(value.active){
                                array.push(value.id);
                            }
                        });
                        this.permissions_values = array
                        this.errors.permissions = ""
                    }
                },
                deep: true
            }
        },
        methods : {
            checkAll: function(){
                this.isCheckAll = !this.isCheckAll;
                const array = [];

                if(this.isCheckAll){
                    this.permissions.map(function(value, key) {
                        array.push(value.id);
                    });
                }

                this.permissions_values = array
            },
            submit(){

                this.form = this.$inertia.form({
                    _method: 'put',
                    id: this.userdata.id,
                    permissions: this.permissions_values
                })

                this.form.post(route("users_permissions.update", this.userdata.id), {
                    preserveState: true,
                    onSuccess: () => {
                        this.closeModal(),
                        this.errors.permissions = ""
                    },
                    onError: () =>  {
                        /*  this.$emit("close") */
                    }
                })

            },
            closeModal() {
                this.isCheckAll = false;
                this.$emit("close");
            },
        },
   })

</script>