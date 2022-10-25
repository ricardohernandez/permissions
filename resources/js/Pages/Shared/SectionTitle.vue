<template lang="">
    <div v-if="title_name" class="px-1   dark:text-white"> <!--   dark:bg-slate-900 dark:text-white -->
        <div class="mb-1 mx-auto px-2 py-2">
            <h2 class="text-base  leading-tight  text-gray-800 dark:text-white"> <!-- dark:border-white dark:text-white dark:bg-slate-900 -->
                {{ title_name }}
            </h2>
        </div>
    </div>
</template>
<script>
export default {
   props : {
       title_name : String
   }
}
</script>
