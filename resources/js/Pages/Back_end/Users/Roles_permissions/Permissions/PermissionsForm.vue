<template lang="">
    <form @submit.prevent="submit">
        <div class="px-1"> 
            <div class="grid grid-cols-6 sm:grid-cols-6"> 
                
                <div class="col-span-2"> 
                   <SelectSearch  ref="moduleitems"  v-model="module_id"  :error="errors.module_id" :options="modulesItems"  :placeholder="__('modules')" />
                </div>
                
                <div class="col-span-2 ml-2"> 
                   <Multiselect  mode="tags" ref="permissionsOptions" v-model="permission"  :error="errors.permission" :options="permissionsOptions"  :placeholder="__('permissions')" />
                </div>

                <div class="col-span-1 ml-1"> 
                    <Button type="submit"  :loading="form.processing" :title="__('save')">
                        <svg  class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>        
                    </Button>
                </div>

            </div>
        </div>    
    </form>
</template>

<script>
import { defineComponent } from 'vue'
import Button from 'Shared/Buttons/BlueButton.vue'
import SelectSearch from 'Shared/Input/SelectSearch.vue'
import Multiselect from 'Shared/Input/Multiselect.vue'

export default defineComponent({
    props: {
        modulesItems: Object,
        permissionsOptions: Object,
        errors: Object
    },
    components: {
        Button,SelectSearch,Multiselect
    },

    data() {
        return {
            module_id : null,
            permission : null,
            form: {}
        }
    },
    methods: {
        submit() {
    
            this.form = this.$inertia.form({
                module_id: this.module_id,
                permission: this.permission,
            })
            
            this.form.post(route("permissions.store", this.form) , {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: (response) => {
                    this.cleanForm()
                }

            })
        },

        cleanForm(){
            this.form = {}
            this.module_id = ""
            this.permission = ""
            this.errors.id = ""
            this.errors.module_id = ""
            this.$refs.permissionsOptions.clear()
        }
    },
})
</script>
<style>
    .cleanForm{
        cursor:pointer;
    }
</style>