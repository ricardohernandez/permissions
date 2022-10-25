<template>
    <app-layout :title="__('roles_permissions')">
        <div class="w-full">
            <div class="overflow-hidden  bg-gray-50  dark:border-gray-600 dark:bg-slate-800 p-2">
                <messages></messages>
                <Menu></Menu>
                
                <!-- <div class="grid sm:grid-cols-4 lg:grid-cols-4"> -->
                <div class="grid xs:grid-cols-1 md:grid-cols-4">

                    <div v-if="$can('permissions.index')"  class="mb-2 xs-col-span-1 md:col-span-2">  
                        <SectionTitle :title_name="__('permissions_modules_create_title')" /> 
                        
                        <PermissionsTable
                            :modules_permissions="modules_permissions" 
                            :modulesItems="modulesItems" 
                            :permissionsOptions="permissionsOptions"
                            :tbfilters="tbfilters"  :errors="errors" />
                    </div>

                    <div v-if="$can('roles.index')" class="mb-2 col-span-1">
                        <SectionTitle :title_name="__('roles_create_title')" />
                        <RolesTable 
                        :roles="roles" 
                        :tbfilters="tbfilters"  :errors="errors" />
                    </div>


                    <div v-if="$can('modules.index')"  class="mb-2 col-span-1">  
                        <SectionTitle :title_name="__('modules_create_title')" /> 
                        <ModulesTable :modules="modules" 
                        :tbfilters="tbfilters"  :errors="errors" />
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
    import RolesTable from './Roles/RolesTable.vue'
    import ModulesTable from './Modules/ModulesTable.vue'
    import PermissionsTable from './Permissions/PermissionsTable.vue'
    
    export default defineComponent({
        components: {
            AppLayout,Menu,RolesTable,PermissionsTable,ModulesTable,Messages,SectionTitle
        },
        props: {
            roles: Object,
            modules_permissions: Object,
            permissionsOptions: Object,
            modules: Object,
            modulesItems: Object,
            tbfilters: Object,
            errors: Object,
        },
     
    })
</script>
