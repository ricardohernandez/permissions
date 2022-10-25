<template>
  <div :class="$attrs.class">

    <label  class="flex relative items-center mb-1 mt-1 cursor-pointer">
        <input 
            id="id" 
            ref="input" 
            type="checkbox"  
            :value="modelValue" 
            v-bind="{ ...$attrs, class: null }" 
            @input="$emit('update:modelValue', $event.target.value)"
            class="sr-only">
        <div class="w-11 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg dark:bg-gray-700 dark:border-gray-600 transition"></div>
        <span class="ml-3 xs:text-sm sm:text-xs  font-medium text-gray-900 dark:text-gray-300 ">{{ placeholder }}</span>
    </label>
  
    <p v-if="error" class="mt-2 xs:text-sm sm:text-xs  text-red-600 dark:text-red-500"><span class="font-medium">{{ error }}</span></p>
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