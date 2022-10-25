<template>
    <app-layout :title="__('users_title')">
       <!--  <div class="p-1"> -->
            <div class="w-full">
               <div class="overflow-hidden  bg-gray-50  dark:border-gray-600 dark:bg-slate-800 p-2">
                    <Messages/>
                    <Menu/>

                    <TableFilters v-if="$can('users_editor.edit')" 
                        :tbfilters="tbfilters" 
                        :initialvalues="initialvalues" 
                        :leaders="leaders"
                        :roles="roles" /> 
         
                    <Table :users="users" 
                        :tbfilters="tbfilters" 
                        :initialvalues="initialvalues"
                        :roles="roles"
                    ></Table>
                    
                </div>
            </div>
       <!--  </div> -->
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Menu from '../Menu.vue'
    import Table from './Table.vue'
    import TableFilters from './TableFilters.vue'
    import Messages from 'Shared/Messages.vue'
    

    export default defineComponent({
        components: {
            AppLayout,Menu,Table,TableFilters,Messages
        },
        props: {
            users: Object,
            roles: Object,
            leaders: Object,
            tbfilters: Object,
            initialvalues: Object,
        },
     
    })
</script>
