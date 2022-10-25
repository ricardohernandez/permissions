<template>
    <Link :href="href" 
        :title="title" 
        :class = "(size=='md')  
            ? 'font-medium rounded-lg xs:text-sm sm:text-xs  mx-auto  w-full block px-6 py-2  -mt-1 text-center  items-center  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  dark:focus:ring-blue-700 dark:hover:bg-blue-800 dark:hover:text-white dark:bg-blue-700 dark:text-gray-100 dark:border-blue-800   disabled:opacity-75 transition'
            : 'font-medium rounded-lg xs:text-sm sm:text-xs  mx-auto  w-full block px-3 py-1  -mt-1 text-center  items-center  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  dark:focus:ring-blue-700 dark:hover:bg-blue-800 dark:hover:text-white dark:bg-blue-700 dark:text-gray-100 dark:border-blue-800   disabled:opacity-75 transition'
    ">
    <slot />
     <span class="xs:text-sm sm:text-xs">{{title}}</span>
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: {
            href: {
                type: String,
            },
            title: {
                type: String,
            },
            size: {
                type: String,
                default: "xs"
            },
        } 
           
    })
</script>
