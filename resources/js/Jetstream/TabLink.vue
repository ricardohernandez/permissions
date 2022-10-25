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
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                    ? 'flex py-1 px-10  border-t border-x border-blue-900  text-sm font-medium text-center text-white rounded-t-lg  bg-blue-700 active hover:bg-blue-700  dark:hover:bg-gray-700 dark:hover:text-white dark:bg-gray-700 dark:text-gray-200 dark:border-gray-900 group transition'
                    : 'flex py-1 px-10  border-t border-x border-gray-200  text-sm font-medium text-center text-gray-800 rounded-t-lg  bg-white active hover:text-white hover:bg-blue-700  dark:hover:bg-gray-700 dark:hover:text-white dark:bg-slate-900 dark:text-gray-200 dark:border-gray-900 group transition'
            }
        }
    })
</script>
