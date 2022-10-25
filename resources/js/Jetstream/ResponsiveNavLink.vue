<template>
    <div>
        <button :class="classes" class="w-full text-left" v-if="as == 'button'">
            <slot></slot>
        </button>

        <Link :href="href" :class="classes" v-else>
            <slot />
        </Link>
    </div>
</template>

<script>
    import { defineComponent } from 'vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['active', 'href', 'as'],

        computed: {
            classes() {
                return this.active
                    ? 'block pl-3 pr-4 py-2 border-blue-900 text-sm font-medium text-indigo-700 bg-indigo-50  dark:hover:bg-gray-700 dark:hover:text-white dark:bg-gray-700 dark:text-gray-200 dark:border-gray-900 transition'
                    : 'block pl-3 pr-4 py-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300  transition'
            }
        }
    })
</script>
