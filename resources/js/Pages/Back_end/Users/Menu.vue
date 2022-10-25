<template>
    <div class=""><!-- mb-1 mx-2 -->
       <div class="mx-auto border-b border-gray-200 dark:border-slate-600 dark:bg-slate-800 ">
            <div class="flex justify-between">
                <div class="flex overflow-x-auto">
                    <div class="space-x-1 ml-1">
                        <jet-nav-link  v-if="$can('users_editor.index')" type="submenu" :href="route('users')" 
                            :active="route().current('users') || route().current('users.*')" >
                            <svg class="mr-2 w-5 h-5 text-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            {{__('user_section_title')}} 
                        </jet-nav-link>
                    </div>
                
                    <div  class="space-x-1  ml-1">
                        <jet-nav-link   v-if="$can('permission_asignation_editor.index')"  type="submenu" :href="route('permissions_asignation')" 
                            :active="route().current('permissions_asignation')  || route().current('permissions_asignation.*')">
                            <svg class="mr-2 w-5 h-5 text-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            {{__('permissions_asignation')}}
                        </jet-nav-link>
                    </div>

                    <div  class="space-x-1  ml-1">
                        <jet-nav-link  v-if="$can('permissions_roles_editor.index')"  type="submenu" :href="route('roles_permissions')" 
                            :active="route().current('roles_permissions')  || route().current('roles_permissions.*')">
                            <svg class="mr-2 w-5 h-5 text-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
                            {{__('roles_permissions')}}
                        </jet-nav-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import JetNavLink  from '@/Jetstream/NavLink.vue'
    export default defineComponent({
        components : {
            JetNavLink 
        }
    })
</script>
