<template lang="">
    <form @submit.prevent="submit">
        <div v-if="$can('modules.edit')" class="px-1"  > 
            <div class="grid grid-cols-6 sm:grid-cols-4 "> 
              
                <div class="col-span-2"> 
                    <text-input ref="module"  v-model="module.namemodule" :error="errors.namemodule" class="mb-1 w-full col-span-1" :placeholder="__('module_name_form')" :size="100" :maxlength="100"/>
                </div>

                <div class="col-span-1 ml-1"> 
                    <Button v-if="moduledata.id!=''" type="submit" :loading="form.processing" :title="__('update')">
                        <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>         
                    </Button>

                    <Button v-else type="submit" :loading="form.processing" :title="__('save')">
                        <svg  class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>        
                    </Button>
                </div>

                <div v-if="moduledata.id!=''" class="col-span-1 ml-1"> 
                    <Button v-if="moduledata.id!=''"  @click="cleanForm" type="button"  class="ml-5" :titlelabel="__('clean')">
                        <svg class="w-4 h-4 cleanForm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </Button>
                </div>
            </div>
        </div>    
    </form>
</template>

<script>
import { defineComponent } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import TextInput from 'Shared/Input/TextInput.vue'
import Button from 'Shared/Buttons/BlueButton.vue'

export default defineComponent({
    props: {
        moduledata: Object,
        errors: Object
    },
    components: {
        TextInput, Button
    },

    data() {
        return {
            module : this.moduledata,
            form: {}
        }
    },
    watch: {
        moduledata: {
            handler(val){
                if(val.id!=""){
                    this.$refs.module.focus()
                    this.errors.namemodule = ""
                }
            },
            deep: true
        }
    },
    methods: {
        submit() {
            if (this.moduledata.id != "") {
                
                this.form = this.$inertia.form({
                    _method: 'put',
                    id: this.module.id,
                    namemodule: this.module.namemodule,
                })

                this.form.post(route("modules.update", this.form.id) , {
                    preserveScroll: true,
                    onSuccess: (response) => {
                         this.form = {}
                         this.moduledata.id = ""
                         this.moduledata.namemodule = ""
                    }

                })

            }else{
                this.form = this.$inertia.form({
                    namemodule: this.module.namemodule
                })
                
                this.form.post(route("modules.store", this.form) , {
                    preserveScroll: true,
                    forceFormData: true,
                    onSuccess: (response) => {
                         console.log("asd")
                         this.form = {}
                         this.moduledata.id = ""
                         this.moduledata.namemodule = ""
                    }

                })

               
            } 
        },

        cleanForm(){
            this.form = {}
            this.moduledata.id = ""
            this.moduledata.namemodule = ""
            this.errors.namemodule = ""
        }
    },
})
</script>
<style>
    .cleanForm{
        cursor:pointer;
    }
</style>