<template lang="">
        <div class="rounded-lg my-1 mx-1 bg-gray-200 shadow-sm   dark:bg-slate-900">
                
            <div class="grid xs:grid-cols-1  sm:grid-cols-4  md:grid-cols-4 lg:grid-cols-8 px-1">

                <div v-if="$can('leaders.create')" class="m-auto w-full lg:col-span-1">
                    <LinkButton as="button"  :href="route('leaders.create')"   :title = "__('leaders_create')">
                        <svg class="inline-block  w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>                 
                    </LinkButton>
                </div>

                <div class="m-auto w-full lg:col-span-1">
                    <label  class="sr-only"></label>
                    <div class="relative block w-full p-1">
                        <search-input v-model="params.search"  :placeholder="__('search')" class="mb-1 w-full col-span-1" />
                    </div>
                </div>
  
            </div>
        </div>
</template>
<script>
    import { Link } from '@inertiajs/inertia-vue3';
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
    import SearchInput from 'Shared/Input/SearchInput.vue'
    import Button from 'Shared/Buttons/BlueButton.vue'
    import LinkButton from 'Shared/Buttons/LinkButton.vue'

    export default {
        props: {
            tbfilters: Object,
        },
        components: {
            Link,JetDropdown,JetDropdownLink,LinkButton,SearchInput,Button 
        },  
        data(){
            return {
                params : {
                    search : this.tbfilters.search,
                    field :  this.tbfilters.field,
                    direction :  this.tbfilters.direction,
                }
            }
        },
        methods : {
           
        },
        watch: {
            params : {
                handler : debounce(function(){
                    let params = pickBy(this.params)
                    this.$inertia.get(this.route('leaders') , params , {
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