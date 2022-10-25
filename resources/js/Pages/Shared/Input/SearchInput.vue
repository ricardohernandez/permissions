<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label block mb-2 xs:text-sm sm:text-xs  font-bold text-gray-900  dark:text-gray-300" :for="id">{{ label }}</label>
    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
    </div>

    <input 
      :id="id" ref="input" 
      :class = "(error)
      ? 'block w-full pl-10 py-1  xs:text-sm sm:text-xs  rounded-md font-bold items-center border bg-red-50  border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500  dark:text-white  dark:bg-gray-700  dark:border-red-400 transition'
      : 'block w-full pl-10 py-1  xs:text-sm sm:text-xs  rounded-md font-bold items-center border border-gray-300 text-gray-900    focus:ring-blue-700  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500  disabled:opacity-75 transition'"  
      type="search" 
      :value="modelValue" 
      :placeholder = "placeholder"
      v-bind="{ ...$attrs, class: null }" 
      @input="$emit('update:modelValue', $event.target.value)"
     />
     
    <p v-if="error" class="mt-2 xs:text-sm sm:text-xs  text-red-600 dark:text-red-500"><span class="font-bold">{{ error }}</span></p>
  </div>
</template>

<script>
import { v4 as uuid } from 'uuid'
export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`
      },
    },
    error: String,
    placeholder : String,
    label: String,
    modelValue: String,
  },
  emits: ['update:modelValue'],
  methods: {
    focus() {
      this.$refs.input.focus()
    },
    select() {
      this.$refs.input.select()
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end)
    },
  },
}
</script>