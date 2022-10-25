<template>
    <app-layout :title="__('permissions_asignation')">
        <div class="w-full">
            <div class="overflow-hidden  bg-gray-50  dark:border-gray-600 dark:bg-slate-800 p-2">
                <messages/>
                <Menu/>
                
                <div class="grid xxs:grid-cols-1 md:grid-cols-2">
                    
                    <div v-if="$can('permission_asignation_to_role.index')"  class="mb-2 col-span-1">
                        <SectionTitle :title_name="__('permissions_asignation_title')" />
                        
                        <RolesPermissionsTable 
                            :roleshaspermissions = "roleshaspermissions" 
                            :roles_items = "roles_items" 
                            :permission_items = "permission_items" 
                            :tbfilters="tbfilters" 
                            :errors="errors" />
                    </div>

                    <div v-if="$can('permission_asignation_to_user.index')"  class="mb-2 col-span-1">
                        <SectionTitle :title_name="__('user_permissions')" />
                        
                        <UsersPermissionsTable 
                            :users = "users" 
                            :users_items = "users_items" 
                            :permission_items = "permission_items" 
                            :tbfilters = "tbfilters" 
                            :errors = "errors" />

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
    import Messages from 'Shared/Messages.vue'
    import SectionTitle from 'Shared/SectionTitle.vue'
    import RolesPermissionsTable from './RolesPermissions/Table.vue'
    import UsersPermissionsTable from './UsersPermissions/Table.vue'
    
    export default defineComponent({
        components: {
            AppLayout,Menu,RolesPermissionsTable,UsersPermissionsTable,Messages,SectionTitle
        },
        props: {
            roleshaspermissions: Object,
            roles_items: Array,
            permission_items: Array,
            users: Object,
            users_items: Array,
            tbfilters: Object,
            errors: Object,
        },

    })
</script>
