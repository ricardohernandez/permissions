<template lang="">
    <div class="grid grid-cols-1 ">
        <div class="col-span-1">

            <div class="m-auto w-full lg:col-span-1">
                <label  class="sr-only"></label>
                <div class="relative block w-full p-1">
                    <search-input v-model="params.searchp"  :placeholder="__('search')" class="mb-1 w-full" />
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import { Inertia } from '@inertiajs/inertia';
    import { Link } from '@inertiajs/inertia-vue3';
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'
    import { throttle } from 'lodash'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import TextInput from 'Shared/Input/TextInput.vue'
    import SearchInput from 'Shared/Input/SearchInput.vue'
    import SelectInput from 'Shared/Input/SelectInput.vue'
    import Button from 'Shared/Buttons/BlueButton.vue'

    export default {
        props: {
            tbfilters: Object,
            permissions: Object,
        },
        components: {
            Link,JetDropdown,JetDropdownLink,TextInput,SearchInput,SelectInput,Button 
        },  
        data(){
            return {
                params : {
                    permission : this.tbfilters.permission === null ? '' : this.tbfilters.permission,
                    search : this.tbfilters.searchp,
                    field :  this.tbfilters.fieldp,
                    direction :  this.tbfilters.directionp,
                }
            }
        },
        watch: {
            params : {
                handler : debounce(function(){
                    let params = pickBy(this.params)
                    this.$inertia.get(this.route('roles_permissions') , params , {
                        replace : true , preserveState : true
                    })
                },550),
                deep : true
            }
        },               
    }
</script>
<style scope>
    input {
        color-scheme: dark;
    }
    ::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }
</style>