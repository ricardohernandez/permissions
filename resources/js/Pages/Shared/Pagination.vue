<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-2 py-1 text-sm leading-4 text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white dark:bg-gray-700 dark:text-gray-200 dark:border-gray-900 border rounded"
                    v-html="link.label" />

                <inertia-link v-else
                    class="mr-1 mb-1 px-2 py-1 text-xs leading-4 border rounded hover:bg-blue-700 hover:text-white dark:hover:bg-gray-600 dark:hover:text-white dark:bg-gray-800 dark:text-gray-300 dark:border-gray-900 transition"
                    :class="{ 'bg-blue-700 text-white dark:bg-gray-600 dark:text-white ': link.active }" 
                    :href="link.url" v-html="link.label" />
            </template>
        </div>
    </div>
</template>
<script>
import {InertiaLink} from "@inertiajs/inertia-vue3";

    export default {
        props: {
            links: Array
        },
        components : {
            InertiaLink
        }
    }
</script>