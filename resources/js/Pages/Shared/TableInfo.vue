<template>
    <div class="text-sm">
        {{__("table_info_records")}} {{ from }}
        {{__("table_info_text1")}}  {{ to }}
        {{__("table_info_text2")}} {{ total }}
    </div>
</template>

<script>
    export default {
        props: {
            from: Number,
            to: Number,
            total: Number
        },
    }
</script>