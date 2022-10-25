<template lang="">
     <app-layout title="Users">
        <div class="py-1">
            <div class="w-full">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:border-gray-600 dark:text-white  dark:bg-slate-900 ">
                    <Menu></Menu>
                    <Messages></Messages> 

                    <SectionTitle :title_name="user_form_title" />

                    <form @submit.prevent="submit" class="px-3 py-1">
                        <div class="grid xs:grid-cols-2  sm:grid-cols-2  md:grid-cols-6 xs:gap-3"> 
                            <text-input v-model="form.name" :error="errors.name" class="mb-1 w-full col-span-1" :label="__('user_name')"/>
                            <text-input v-model="form.email" :error="errors.email" class="mb-1 w-full col-span-1" :label="__('user_email')"/>
                            <text-input v-model="form.phone" :error="errors.phone" class="mb-1 w-full col-span-1" :label="__('user_phone')"/>
                            <date-input v-model="form.date" :error="errors.date"  class="mb-1 w-full col-span-1" :label="__('user_date_addmission')"/>
                            <select-input v-if="edit_mode && $can('users_editor.restore')" v-model="form.active" :error="errors.active" class="mb-1 w-full col-span-1" :label="__('user_active')">
                               <option :value="1">{{ __('user_activated') }}</option>
                               <option :value="2">{{ __('user_noactivated') }}</option>
                            </select-input> 

                            <select-input v-if="$can('users_editor.edit')" v-model="form.role" :error="errors.role" class="mb-1 w-full col-span-1" :label="__('role')">
                               <option v-for="role in roles" :key="role.id" :value="role.id">{{role.name}}</option>
                            </select-input> 

                            <select-input v-if="$can('leaders.edit')" v-model="form.leader_id" :error="errors.leader" class="mb-1 w-full col-span-1" :label="__('leader')">
                               <option v-for="leader in leaders" :key="leader.id" :value="leader.id">{{leader.user.name}}</option>
                            </select-input> 

                            <file-input @change="form.photo = $event.target.files[0]" v-model="form.photo" :error="errors.photo" class="mb-1 w-full col-span-1" :label="__('user_photo')" type="file" accept="image/*"  />

                            <div v-if="edit_mode && $can('leaders.edit')" class="m-auto w-full ml-1 mt-1  lg:col-span-1">
                                <label  class="flex relative items-center mt-1 cursor-pointer">
                                    <input v-model="form.isleader"  type="checkbox"  class="sr-only">
                                    <div class="w-10 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600"></div>
                                    <span class="ml-2 text-xs font-medium text-gray-900 dark:text-gray-300 ">{{__('is_leader')}}</span>
                                </label>
                            </div>
                            
                        </div>

                       <div class="flex justify-center mt-3">
                            <div v-if="$can('users_editor.edit')">
                                <BlueButton size="md" type="submit" :loading="form.processing" :title="__('save')">
                                    <svg class="xs:w-6 xs:h-6 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>         
                                </BlueButton>
                            </div>    

                            <div class="ml-2 mt-1.5">
                                <LinkButton as="button" size="md" :href="route('users')"   :title = "__('back')">
                                    <svg class="inline-block  xs:w-6 xs:h-6 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z"></path></svg>          
                                </LinkButton>
                            </div>
                        </div>

                       <!--  <div class="mt-2 flex justify-center">
                       
                        </div> -->

                    </form>
                </div>
            </div>
        </div>
    </app-layout>
      
</template>
<script>
import { defineComponent } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue'
import Menu from '../Menu.vue'
import Messages from 'Shared/Messages.vue'
import TextInput from 'Shared/Input/TextInput.vue'
import DateInput from 'Shared/Input/DateInput.vue'
import FileInput from 'Shared/Input/FileInput.vue'
import SelectInput from 'Shared/Input/SelectInput.vue'
import BlueButton from 'Shared/Buttons/BlueButton.vue'
import LinkButton from 'Shared/Buttons/LinkButton.vue'
import SectionTitle from 'Shared/SectionTitle.vue'

export default defineComponent({
    props: {
        errors: Object,
        userdata: Object,
        leaders: Object,
        isLeader : Boolean,
        roles: Object
    },
    components: {
        AppLayout, LinkButton, Menu, Messages, TextInput, DateInput, FileInput,SelectInput,BlueButton,SectionTitle
    },
    data() {
        return {
            form : "",
            user_form_title : "",
            edit_mode : false
        }
    },
    mounted() {
        if (this.userdata != undefined) {
           
            this.form = this.$inertia.form({
                _method: 'put',
                id: this.userdata.id,
                name: this.userdata.name,
                email: this.userdata.email,
                phone: this.userdata.phone,
                date: this.userdata.date_admission,
                active: this.userdata.active,
                isleader: this.userdata.isleader,
                leader_id: this.userdata.leader_id,
                role: this.userdata.roles[0].id,
                photo: null,
            })
            this.edit_mode = true
            this.user_form_title = this.__('user_edit_title') + " " + this.userdata.name

        } else {
            this.form = this.$inertia.form({
                name: null,
                email: null,
                phone: null,
                date: null,
                active: null,
                isleader: false,
                leader_id: null,
                photo: null,
                role: null,
            })
            this.edit_mode = false
            this.user_form_title = this.__('user_form_title')
        }
    },
    methods: {
        submit() {

            if (this.userdata !== undefined) {
                this.form.post(route("users.update", this.userdata.id), {
                    onSuccess: () => console.log("ok")
                })
            } else {
                this.form.post(route('users.store'), this.form, {
                    forceFormData: true
                });
            }

        },

    },
})
</script>
