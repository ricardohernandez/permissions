<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },  
        props: ['href', 'active' , 'type'],

        computed: {
            classes() {
                if(this.type=="submenu"){
                      return this.active
                    ? 'flex xs:py-2 sm:py-1   xs:px-5 sm:px-10  whitespace-nowrap border-t border-x border-blue-900  xs:text-base sm:text-sm  font-medium text-center text-white rounded-t-lg  bg-blue-700 active hover:bg-blue-700  dark:hover:bg-slate-700 dark:hover:text-white dark:bg-slate-700 dark:text-gray-200 dark:border-none group transition'
                    : 'flex xs:py-2 sm:py-1  xs:px-5 sm:px-10   whitespace-nowrap border-t border-x border-gray-200 xs:text-base sm:text-sm font-medium text-center text-gray-800 rounded-t-lg  bg-white active hover:text-white hover:bg-blue-700  dark:hover:bg-slate-700 dark:hover:text-white dark:bg-slate-900 dark:text-gray-200 dark:border-none group transition'
                }else{
                    return this.active
                    ? 'inline-flex items-center whitespace-nowrap px-1 pt-1 border-b-2 border-blue-700 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition dark:hover:bg-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:text-white'
                    : 'inline-flex items-center whitespace-nowrap px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-blue-700 focus:outline-none  dark:hover:bg-gray-600 dark:hover:text-white dark:text-white transition'
                }
              
            }
        }
    })
</script>
