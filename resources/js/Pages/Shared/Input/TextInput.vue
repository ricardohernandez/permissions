<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label block mb-2 xs:text-sm sm:text-xs  font-bold text-gray-900 dark:text-gray-300" :for="id">{{ label }}</label>
    <input 
      :id="id" 
      ref="input"
      :class = "(error)
      ? 'block w-full pl-5 mt-0.5 py-1 px-8 xs:text-sm sm:text-xs  rounded-md font-bold items-center border bg-red-50  border-red-500 text-red-900 placeholder-red-700  focus:ring-red-500 focus:border-red-500  focus:ring-1 dark:focus:ring-2  dark:text-white  dark:bg-gray-700  dark:border-red-400 transition'
      : 'block w-full pl-5 mt-0.5 py-1 xs:text-sm sm:text-xs  rounded-md font-bold items-center border border-gray-300 ring-gray-500 text-gray-900  focus:ring-1 dark:focus:ring-2  focus:ring-blue-700  dark:focus:ring-blue-700  dark:hover:text-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-900  disabled:opacity-75 transition'"  
      type="text" 
      :value="modelValue" 
      :size="size"
      :maxlength="maxlength"
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
    edit: Boolean,
    placeholder : String,
    label: String,
    size: Number,
    maxlength: Number,
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