<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label block mb-2 xs:text-sm sm:text-xs  font-bold text-gray-900 dark:text-gray-300" :for="id">{{ label }}</label>
    
    <input type="date"
      :id="id" ref="input" 
      :class = 
        "(error) ? 
        'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 xs:text-sm sm:text-xs  rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-1 dark:text-white  dark:bg-gray-700  dark:border-red-400 transition'
        :'date-input block pl-2  w-full p-1  xs:text-sm sm:text-xs  rounded-lg bg-gray-50 border border-gray-300 text-gray-900  focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-200 dark:focus:ring-blue-500 dark:focus:border-blue-500 transition'"  
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
    type : String
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