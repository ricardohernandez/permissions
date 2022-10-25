<template lang="">
    <form @submit.prevent="submit">
        <div class="px-1"> 
            <div class="grid xxs:grid-cols-2 sm:grid-cols-4 gap-1"> 
                
                <div class="xxs:col-span-1 sm:col-span-1"> 
                    <!-- <select-input  ref="useritems" v-model="values.useritems" :error="errors.useritems" class="mb-1 w-full col-span-1">
                        <option value="">{{ __('users_title') }}</option>
                        <option v-for="user , index in users_items" :key="user.id" :value="user.id"> {{ user.name }} </option>
                    </select-input> -->
                    
                    <SelectSearch  ref="useritems"  v-model="uservalue"  :error="errors.uservalue" :options="users_items"  :placeholder="__('users_title')" />
                </div>
      
                <div class="xxs:col-span-1 sm:col-span-1"> 
                    <Multiselect  mode="multiple" ref="permissionsselect"  v-model="permissionuservalue"  :error="errors.permissionuservalue" :options="permission_items"  :placeholder="__('permissions')" />
                </div>

                <div class="w-full xs:col-span-1  sm:col-span-1"> 
                    <Button type="submit" :loading="form.processing" :title="__('update')">
                        <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>         
                    </Button>
                </div>

                <div v-if="uservalue!=null" class="col-span-1 "> 
                    <Button v-if="uservalue!=null" type="button" @click="cleanForm"  class="ml-5" :titlelabel="__('clean')">
                        <svg class="w-4 h-4 cleanForm" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </Button>
                </div>
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
import SelectSearch from 'Shared/Input/SelectSearch.vue'


export default defineComponent({
    props: {
        users_items: Array,
        permission_items: Array,
        userspermissiondata: Object,
        errors: Object
    },
    components: {
        TextInput, Button ,SelectInput ,Multiselect,SelectSearch
    },
    data() {
        return {
            uservalue : null,
            permissionuservalue : null,
            form: {}
        }
    },
    watch: {
        userspermissiondata: {
            handler(val){
                if(val.useritems!=""){
                    this.uservalue = this.userspermissiondata.useritems[0].value
                    this.permissionuservalue = this.userspermissiondata.permissionsitems
                    this.$refs.permissionsselect.focus()
                    this.errors.uservalue = ""
                    this.errors.permissionuservalue = ""
                }
            },
            deep: true
        }
    },
    methods: {
        submit() {
                
            this.form = this.$inertia.form({
                uservalue: this.uservalue,
                permissionuservalue: this.permissionuservalue
            })
            
            this.form.post(route("users_permissions.store", this.form) , {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: (response) => {
                    this.cleanForm()
                }
            })
        },
        cleanForm(){
            this.form = {}
            this.$refs.useritems.clear()
            this.$refs.permissionsselect.clear()
            this.errors.uservalue = ""
            this.errors.permissionuservalue = ""
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