<template lang="">
    <div class="my-2"><!-- rounded-lg my-1 mx-1 bg-gray-200 shadow-sm  dark:bg-slate-900 -->
        <!--  <div class="flex justify-between">
        <div class="flex"> -->
        <div class="grid xs:grid-cols-2  sm:grid-cols-4  md:grid-cols-4 lg:grid-cols-10  gap-4">

            <div v-if="$can('users_editor.create')" class="m-auto w-full lg:col-span-1">
                <LinkButton as="button"  :href="route('users.create')"   :title = "__('user_filter_create')">
                    <svg class="inline-block  w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>                 
                </LinkButton>
            </div>
            
            <div class=" m-auto w-full xs:col-span-1 lg:col-span-1">
                <div class="relative block w-full"> 
                    <date-input v-model="params.date_from"  class="mb-1 w-full col-span-1"/>
                </div>
            </div>

            <div class=" m-auto w-full xs:col-span-1 lg:col-span-1">
                <div class="relative block w-full"> 
                    <date-input v-model="params.date_now"  class="mb-1 w-full col-span-1"/>
                </div>
            </div>

            <div class="m-auto w-full xs:col-span-1 lg:col-span-1">
                <div class="relative block w-full">
                <select-input v-model="params.role" class="mb-1 w-full col-span-1">
                    <option value="" selected>{{__('user_filter_role')}}</option>
                    <option v-for="rol in roles" :key="rol.id">{{ rol.name }}</option>
                </select-input>
                </div>
            </div>

            <div class="m-auto w-full xs:col-span-1 lg:col-span-1">
                <div class="relative block w-full">
                <select-input v-model="params.leader" class="mb-1 w-full col-span-1">
                    <option value="" selected>{{__('leaders')}} | {{__('all')}}</option>
                    <option v-for="leader in leaders" :key="leader.id" :value="leader.id">{{ leader.user.name }}</option>
                </select-input>
                </div>
            </div>

            <div class="m-auto w-full xs:col-span-1 lg:col-span-1">
                <label  class="sr-only"></label>
                <div class="relative block w-full">
                    <search-input v-model="params.search"  :placeholder="__('search')" class="mb-1 w-full col-span-1" />
                </div>
            </div>

            <div class="m-auto w-full xs:col-span-1 lg:col-span-1">
                <div class="relative block w-full">
                    <select-input v-model="params.active"  class="mb-1 w-full col-span-1">
                        <option value="0"> {{ __('state') }} | {{ __('all') }} </option>
                        <option value="1" selected> {{ __('user_activated') }} </option>
                        <option value="2"> {{ __('user_noactivated') }} </option>
                    </select-input> 
                </div>
            </div>

            <div class="m-auto w-full xs:col-span-1 ml-1   lg:col-span-1">
                <label  class="flex relative items-center cursor-pointer">
                    <input v-model="params.only_leaders"  type="checkbox"  class="sr-only">
                    <div class="w-10 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600"></div>
                    <span class="ml-2 xs:text-sm sm:text-xs  font-medium text-gray-900 dark:text-gray-300 ">{{__('user_filter_only_leaders')}}</span>
                </label>
            </div>

            <div class="m-auto w-full xs:col-span-1 ml-1   lg:col-span-1">
                <label  class="flex relative items-center cursor-pointer">
                    <input v-model="params.no_verified"  type="checkbox"  class="sr-only">
                    <div class="w-10 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600"></div>
                    <span class="ml-2 xs:text-sm sm:text-xs  font-medium text-gray-900 dark:text-gray-300 ">{{__('user_filter_verify')}}</span>
                </label>
            </div>

            <div v-if="$can('users_editor.export')" class="m-auto w-full  xs:col-span-1 lg:col-span-1">
                <jet-dropdown align="right" width="48">
                    <template #trigger>
                            <button type="button" class="w-full block font-semibold rounded-lg xs:text-sm sm:text-xs  px-2 py-1 mx-auto items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  dark:focus:ring-blue-700 dark:hover:bg-blue-800 dark:hover:text-white dark:bg-blue-700 dark:text-gray-100 dark:border-blue-800 transition">
                                {{__('user_filter_export')}}
                                <svg class="inline-block  w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                    </template>

                    <template #content>
                    <jet-dropdown-link as="button" @click="exportExcel()">
                        Excel 
                    </jet-dropdown-link>

                    <jet-dropdown-link as="button" @click="exportPdf()">
                        PDF
                    </jet-dropdown-link>
                    
                    </template>
                </jet-dropdown>

            </div>
        </div>
    </div>
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import TextInput from 'Shared/Input/TextInput.vue'
    import SearchInput from 'Shared/Input/SearchInput.vue'
    import SelectInput from 'Shared/Input/SelectInput.vue'
    import DateInput from 'Shared/Input/DateInput.vue'
    import CheckInput from 'Shared/Input/CheckInput.vue'
    import Button from 'Shared/Buttons/BlueButton.vue'
    import LinkButton from 'Shared/Buttons/LinkButton.vue'

    export default {
        props: {
            tbfilters: Object,
            initialvalues: Object,
            roles: Object,
            leaders: Object,
        },
        components: {
            Link,JetDropdown,JetDropdownLink,LinkButton,TextInput,SearchInput,DateInput,SelectInput,CheckInput,Button 
        },  
        data(){
            return {
                params : {
                    date_from : this.initialvalues.date_from,
                    date_now : this.initialvalues.date_now,
                    no_verified : this.initialvalues.no_verified,
                    only_leaders : this.initialvalues.only_leaders,
                    active : this.initialvalues.active,
                    role : this.tbfilters.role === null ? '' : this.tbfilters.role,
                    leader : this.tbfilters.leader === null ? '' : this.tbfilters.leader,
                    search : this.tbfilters.search,
                    field :  this.tbfilters.field,
                    direction :  this.tbfilters.direction,
                }
            }
        },
        methods : {
            exportExcel(){
                window.location.href = route('excelUsers' , this.params)
            },
             exportPdf(){
                window.location.href = route('exportPdf' , this.params)
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
    }
</script>
<style scope>
    input {
        color-scheme: dark;
    }
    ::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>