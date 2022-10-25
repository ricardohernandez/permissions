<template>
  <div :class="$attrs.class">
    <label v-if="label" class="form-label block mb-2 text-xs font-medium text-gray-900 dark:text-gray-300" :for="id">{{ label }}</label>
    <input 
    :id="id" ref="input" 
    class="block w-full  p-0 text-xs text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
    :type="type" 
    :value="modelValue" 
    v-bind="{ ...$attrs, class: null }" 
    @input="$emit('update:modelValue', $event.target.value)"
     />
    <p v-if="error" class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium">{{ error }}</span></p>
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
    type: {
      type: String,
      default: 'file',
    },
    error: String,
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