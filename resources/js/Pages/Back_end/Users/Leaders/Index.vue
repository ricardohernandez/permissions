<template>
    <app-layout :title="__('users_title')">
        <div class="w-full">
            <div class="overflow-hidden  bg-gray-50  dark:border-gray-600 dark:bg-slate-800 p-2">
                <messages></messages>
                <Menu></Menu>
                <TableFilters v-if="$can('leaders.edit')" :tbfilters="tbfilters"/>
        
                <Table :leaders="leaders" 
                    :tbfilters="tbfilters" />
                
            </div>
        </div>
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
            leaders: Object,
            tbfilters: Object,
        },
     
    })
</script>
