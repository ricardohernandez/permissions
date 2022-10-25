<template>
    <Head :title="__('login_title')" />
        
    <div class="text-gray-800 bg-blue-700 dark:text-slate-100 dark:bg-slate-900">
        <div class="flex flex-col  min-h-screen items-center justify-center bg-gradient-to-tr from-blue-700 via-blue-900 to-blue-800 dark:from-slate-700 dark:via-slate-900 dark:to-slate-800">
            
           <!--  <Link :href="'/'" class="mb-2">
                <svg class="w-16 h-16" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"/>
                    <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"/>
                </svg>
            </Link> -->
            
            <form  @submit.prevent="submit" class="rounded-2xl flex-col   bg-white flex w-11/12 md:w-7/12 lg:w-6/12 xl:w-4/12 shadow-2xl dark:bg-slate-900/70 ">
                <div class="flex-1 p-6">
                    <div class="mb-6 last:mb-0">
                        <label class="block font-bold mb-2">{{__('login_user')}}</label>

                        <jet-validation-errors class="my-2" />

                        <div v-if="status" class="my-2 font-medium text-sm text-green-600">
                            {{ status }}
                        </div>

                        <div class="">
                            <div class="relative">
                                <input :disabled="form.processing"  v-model="form.username"  type="text" class="px-3 py-1 max-w-full focus:ring focus:outline-none border-gray-700 rounded w-full dark:placeholder-gray-400 h-12 border bg-white dark:bg-slate-800 pl-10">
                                <span class="inline-flex justify-center items-center w-10 h-12 absolute top-0 left-0 z-10 pointer-events-none text-gray-500 dark:text-slate-400">
                                    <svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                                    <path fill="currentColor" d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="mb-6 last:mb-0">
                        <label class="block font-bold mb-2">{{__('login_password')}}</label>
                        <div class="">
                            <div class="relative">
                                <input  :disabled="form.processing" v-model="form.password" required   type="password" class="px-3 py-1 max-w-full focus:ring focus:outline-none border-gray-700 rounded w-full dark:placeholder-gray-400 h-12 border bg-white dark:bg-slate-800 pl-10">
                                <span class="inline-flex justify-center items-center w-10 h-12 absolute top-0 left-0 z-10 pointer-events-none text-gray-500 dark:text-slate-400">
                                    <svg viewBox="0 0 24 24" width="16" height="16" class="inline-block">
                                    <path fill="currentColor" d="M21 13H14.4L19.1 17.7L17.7 19.1L13 14.4V21H11V14.3L6.3 19L4.9 17.6L9.4 13H3V11H9.6L4.9 6.3L6.3 4.9L11 9.6V3H13V9.4L17.6 4.8L19 6.3L14.3 11H21V13Z"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                       
                    </div>

                    <div class="mt-1">
                        <label class="flex items-center">
                            <div class="form-check">
                            <input v-model="form.remember"  class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label inline-block text-gray-800 ml-2 text-sm dark:text-gray-100" for="flexCheckDefault">
                                 {{__('login_remember_me')}} 
                            </label>
                            </div>

                          <!--  <input type="checkbox"  v-model="form.remember"  class="rounded  shadow-sm  text-blue-600  dark:text-blue-800">
                                
                            <span class="ml-2 text-sm text-gray-600 dark:text-gray-100 ">  {{__('login_remember_me')}} </span> -->
                        </label>
                    </div>
                   
                </div>
                <footer class="sm:px-12 sm:py-4 xs:px-2 xs:py-2">
                    <div class="flex  xs:justify-between -mb-3">
                    <button :disabled="form.processing" class="inline-flex cursor-pointer justify-center items-center whitespace-nowrap focus:outline-none transition-colors focus:ring duration-150 border rounded border-blue-700 dark:border-blue-600 ring-blue-300 dark:ring-blue-800 bg-blue-700 dark:bg-blue-500 text-white hover:bg-blue-800 hover:border-blue-800 hover:dark:bg-blue-700 hover:dark:border-blue-600 py-2 px-3 mr-3 last:mr-0 mb-3 disabled:opacity-40 " type="submit">
                        <svg  v-if="form.processing" role="status" class="mr-2 w-4 h-4 text-gray-100 animate-spin dark:text-gray-200 fill-white" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>   
                        <!----><span class="px-2">   {{__('login_btn_login')}}</span>
                    </button>
                    <a v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-100 dark:hover:text-gray-300 py-2 px-3 mr-3 last:mr-0 mb-3 mt-1 transition">
                        <!----><span class="px-2"> {{__('login_forgotten_pass')}}</span>
                    </a>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        props: {
            canResetPassword: Boolean,
            status: String,
            errors: Object,
        },

        data() {
            return {
                form: this.$inertia.form({
                    username: '',
                    password: '',
                    remember: true
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember
                    }))
                    .post(this.route('log_in'), {
                        preserveScroll: true,
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
