<template lang="">
    <form @submit.prevent="submit">
        <div class="px-1"> 
            <div class="grid xxs:grid-cols-2 sm:grid-cols-7 gap-1"> 
                
                <div class="col-span-1"> 
                    <select-input  ref="rolesitems"   v-model="values.rolesitems" :error="errors.rolesitems" class="mb-1 w-full col-span-1">
                        <option value="">{{ __('role') }}</option>
                        <option v-for="role , index in roles_items" :key="role.id" :value="role.id"> {{ role.name }} </option>
                    </select-input>
                </div>
      
                <div class="xxs:col-span-1 sm:col-span-4 ml-1"> 
                    <Multiselect   mode="tags" ref="permissionsselect"  v-model="permissionvalue"  :error="errors.permissionvalue" :options="permission_items"  :placeholder="__('permissions')" />
                </div>

                <div class="w-full xs:col-span-1  sm:col-span-1"> 
                    <Button type="submit" :loading="form.processing" :title="__('update')">
                        <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>         
                    </Button>
                </div>

                <div v-if="rolespermissiondata.rolesitems!=''" class="w-full col-span-1 ml-1"> 
                    <Button v-if="rolespermissiondata.rolesitems!=''"  @click="cleanForm"  class="ml-5" :titlelabel="__('clean')">
                        <svg class="w-4 h-4 cleanForm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </Button>
                </div>

                
            <!-- <div class="grid grid-cols-1 sm:grid-cols-1">     
                <div class="col-span-1 ml-2"> 
                    <Multiselect   mode="tags" ref="permissionsselect"  v-model="permissionvalue"  :error="errors.permissionvalue" :options="permission_items"  :placeholder="__('permissions')" />
                </div>
            </div> -->


            </div>
        </div>    
    </form>
</template>

<script>

import { defineComponent } from 'vue'
import SelectInput from 'Shared/Input/SelectInput.vue'
import TextInput from 'Shared/Input/TextInput.vue'
import Button from 'Shared/Buttons/BlueButton.vue'
import Multiselect from 'Shared/Input/Multiselect.vue'

export default defineComponent({
    props: {
        roles_items: Array,
        permission_items: Array,
        rolespermissiondata: Object,
        errors: Object
    },
    components: {
        TextInput, Button ,SelectInput ,Multiselect
    },
    data() {
        return {
            values : this.rolespermissiondata,
            permissionvalue : null,
            value: null,
            form: {}
        }
    },
    watch: {
        rolespermissiondata: {
            handler(val){
                if(val.rolesitems!=""){
                    this.$refs.permissionsselect.focus()
                    this.permissionvalue = this.rolespermissiondata.permissionsitems
                    this.errors.rolesitems = ""
                    this.errors.permissionvalue = ""
                }
            },
            deep: true
        }
    },
    methods: {
        submit() {
                
            this.form = this.$inertia.form({
                rolesitems: this.values.rolesitems,
                permissionvalue: this.permissionvalue
            })
            
            this.form.post(route("permissions_asignation.store", this.form) , {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: (response) => {
                    this.cleanForm()
                }
            })
        },
        cleanForm(){
            this.form = {}
            this.rolespermissiondata.rolesitems = ""
            this.$refs.permissionsselect.clear()
            this.errors.rolesitems = ""
            this.errors.permissionvalue = ""
        }
    },
})
</script>

<style>
.multiselect-green {
  --ms-tag-bg: #D1FAE5;
  --ms-tag-color: #059669;
}
</style>