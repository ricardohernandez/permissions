<template>
   
    <confirmation :show="isConfirmDeleteModalVisible" @close="closeModal">
            <template #title>
                 {{ __('delete') }} {{ title }}
            </template>

            <template #content>
                {{ __('confirmDeleteTitle') }}
            </template>

            <template #footer>
                 <div class="flex justify-center">
                    <div class="basis-3/4">
                        <RedButton size="md"  @click="deleteRecord"  :title="__('confirmDeleteMsg')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </RedButton>
                    </div>
                    <div class="basis-1/4">
                        <Button size="md" @click="closeModal"  class="ml-5" :title="__('close')">
                                <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </Button>
                    </div>
                </div>
            </template>
    </confirmation>
   
</template>

<script>
    import { defineComponent } from 'vue'
    import Confirmation from 'Shared/Modals/Confirmation.vue'
    import Button from 'Shared/Buttons/BlueButton.vue'
    import RedButton from 'Shared/Buttons/RedButton.vue'
      
    export default defineComponent({
        components: {
            Button,RedButton,Confirmation
        }, 
        props: {
            id: {
                required: true,
            },
            isConfirmDeleteModalVisible: {
                type: Boolean,
                default: false
            },
            title: {
                type: String,
                default: ""
            },
        },
        emits: ['deleteRecordEvent'],
        methods : {
            close() {
                this.$emit("close");
            },
            deleteRecord() {
                this.$emit("deleteRecordEvent",this.id);
            },
            closeModal() {
                this.$emit("close");
            },
          
        },
   })

</script>