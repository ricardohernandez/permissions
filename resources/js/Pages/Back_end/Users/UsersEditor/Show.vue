<template lang="">
     <app-layout title="Users">
        <div class="py-1">
            <div class="w-full">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg dark:border-gray-600 dark:text-white  dark:bg-slate-900 ">
                    <Menu></Menu>
                    <SectionTitle :title_name="userdata.name" />
                   
                        <div class="grid xs:grid-cols-2  sm:grid-cols-2  md:grid-cols-6 xs:gap-3"> 

                        <input-info :value="userdata.name"   class="mb-1 w-full col-span-1" :label="__('user_name')"/>
                        <input-info :value="userdata.email"  class="mb-1 w-full col-span-1" :label="__('user_email')"/>
                        <input-info :value="userdata.phone"  class="mb-1 w-full col-span-1" :label="__('user_phone')"/>
                        <input-info :value="userdata.date_admission"   class="mb-1 w-full col-span-1" :label="__('user_date_addmission')"/>
                        <input-info :value="userdata.roles[0].name"   class="mb-1 w-full col-span-1" :label="__('role')"/>

                        <a class="mb-1 w-full col-span-1" v-if="userdata.profile_photo_path!=null" target="_blank" :href="`/${userdata.profile_photo_path}`">
                            <img :src="`/${userdata.profile_photo_path}`" class="w-12 h-12 rounded-full">
                        </a>

                    </div>

                    <div class="flex justify-center mt-3">
                        <div class="mt-1.5">
                            <LinkButton as="button" size="md" :href="route('users')"   :title = "__('back')">
                                <svg class="inline-block  w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0019 16V8a1 1 0 00-1.6-.8l-5.333 4zM4.066 11.2a1 1 0 000 1.6l5.334 4A1 1 0 0011 16V8a1 1 0 00-1.6-.8l-5.334 4z"></path></svg>          
                            </LinkButton>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
      
</template>
<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import Menu from '../Menu.vue'
import InputInfo from 'Shared/Input/InputInfo.vue'
import LinkButton from 'Shared/Buttons/LinkButton.vue'
import SectionTitle from 'Shared/SectionTitle.vue'

export default defineComponent({
    props: {
        userdata: Object,
    },
    components: {
        AppLayout, LinkButton, Menu, InputInfo, SectionTitle
    },
    data() {
        return {
            /* user_form_title : this.userdata.name, */
        }
    },
  
})
</script>
