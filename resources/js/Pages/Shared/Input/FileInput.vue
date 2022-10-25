<template>
  <div>
    <label v-if="label" class="form-label block mb-2 xs:text-sm sm:text-xs  font-bold text-gray-900 dark:text-gray-300">{{ label }}</label>
      <input ref="file" type="file" :accept="accept" class="hidden" @change="change" />
      <div v-if="!modelValue" class="">
        <button type="button" class="font-bold rounded-lg xs:text-sm sm:text-xs  px-3 py-1 mt-0.5 text-center inline-flex items-center  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  dark:focus:ring-blue-800 dark:hover:bg-gray-600 dark:hover:text-white dark:bg-gray-700 dark:text-gray-200 dark:border-gray-900   disabled:opacity-75 transition" @click="browse">  {{__('browse')}}</button>
      </div>
      <div v-else class="flex items-center justify-between p-1">
        <div class="flex-1 pr-1 xs:text-sm sm:text-xs ">
          {{ modelValue.name }} <span class="text-gray-500 xs:text-sm sm:text-xs ">({{ filesize(modelValue.size) }})</span>
        </div>
        <button type="button" class="font-bold rounded-lg xs:text-sm sm:text-xs  px-3 py-1 mt-0.5 text-center inline-flex items-center  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  dark:focus:ring-blue-800 dark:hover:bg-gray-600 dark:hover:text-white dark:bg-gray-700 dark:text-gray-200 dark:border-gray-900   disabled:opacity-75 transition" @click="remove">  {{__('remove')}}</button>
      </div>
    <p v-if="error" class="mt-2 xs:text-sm sm:text-xs  text-red-600 dark:text-red-500"><span class="font-bold">{{ error }}</span></p>
  </div>
</template>

<script>
export default {
  props: {
    modelValue: File,
    label: String,
    accept: String,
    error: String,
  },
  emits: ['update:modelValue'],
  watch: {
    modelValue(value) {
      if (!value) {
        this.$refs.file.value = ''
      }
    },
  },
  methods: {
    filesize(size) {
      var i = Math.floor(Math.log(size) / Math.log(1024))
      return (size / Math.pow(1024, i)).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i]
    },
    browse() {
      this.$refs.file.click()
    },
    change(e) {
      this.$emit('update:modelValue', e.target.files[0])
    },
    remove() {
      this.$emit('update:modelValue', null)
    },
  },
}
</script>