<template>
   <!--   :groups="true"-->  

  <div :class="$attrs.class">
  <Multiselect
      :id="id" 
      :mode="mode"
      ref="input" 
      :options="options"
      :placeholder="placeholder"
      :object="true"
      :resolve-on-load="false"
      :min-chars="1"
      :searchable="true"
      :closeOnSelect="false"
      :clearOnSelect="false"
      :canDeselect="true"
      :canClear="true"
      :clearOnSearch="true"

      :classes = "(error)
        ? {
          container: 'xs:text-sm sm:text-xs  min-h-6 relative mx-auto w-full flex items-center justify-end box-border cursor-pointer  rounded-lg bg-white  border border-gray-300 leading-snug outline-none  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:border-red-500  bg-red-50 border border-red-500 text-red-900 placeholder-red-700    focus:border-red-500   dark:text-white  dark:bg-gray-700   dark:border-red-400',
          containerDisabled: 'cursor-default bg-gray-100',
          containerOpen: 'rounded-lg-b-none',
          containerOpenTop: 'rounded-lg-t-none',
          containerActive: 'ring-1 ring-red-500 ',
          singleLabel: 'flex items-center h-5 max-w-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 pr-16 box-border rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
          singleLabelText: 'overflow-ellipsis overflow-hidden block whitespace-nowrap max-w-full',
          multipleLabel: 'flex items-center h-6 absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
          search: 'w-full absolute inset-0 outline-none focus:ring-0 appearance-none box-border border-0 xs:text-sm sm:text-xs  font-sans bg-white rounded-lg pl-3.5 rtl:pl-0 rtl:pr-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300  dark:focus:border-red-500  bg-red-50 border border-red-500 text-red-900 placeholder-red-700   focus:border-red-500   dark:text-white  dark:bg-gray-700   dark:border-red-400',
          tags: 'flex-grow flex-shrink flex flex-wrap items-center pl-2 rtl:pl-0 rtl:pr-2',
          tag: 'xs:text-sm sm:text-xs  font-semibold py-0.5 pl-2 rounded-lg mr-1  flex items-center whitespace-nowrap rtl:pl-0 rtl:pr-2 rtl:mr-0 rtl:ml-1 bg-red-500 text-white  dark:bg-gray-600  dark:text-white ',
          tagDisabled: 'pr-2 opacity-50 rtl:pl-2',
          tagRemove: 'flex items-center justify-center p-1 mx-0.5 rounded-lg-sm hover:bg-black hover:bg-opacity-10 group',
          tagRemoveIcon: 'bg-multiselect-remove bg-center bg-no-repeat opacity-90 inline-block w-3 h-3 group-hover:opacity-60',
          tagsSearchWrapper: 'inline-block relative mx-1 mb-1 flex-grow flex-shrink h-full',
          tagsSearch: 'absolute inset-0 border-0 outline-none focus:ring-0 appearance-none p-0 xs:text-sm sm:text-xs  font-sans box-border w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500  bg-red-50 border border-red-500 text-red-900 placeholder-red-700    focus:border-red-500   dark:text-white  dark:bg-gray-700   dark:border-red-400',
          tagsSearchCopy: 'invisible whitespace-pre-wrap inline-block h-px',
          placeholder: 'flex items-center h-6 absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 text-gray-900 dark:text-gray-300 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
          caret: 'bg-multiselect-caret bg-center bg-no-repeat w-2.5 h-4 py-px box-content mr-3.5 relative z-10 opacity-50 flex-shrink-0 flex-grow-0 transition-transform transform pointer-events-none rtl:mr-0 rtl:ml-3.5',
          caretOpen: 'rotate-180 pointer-events-auto',
          clear: 'pr-3.5 relative z-10 opacity-90 transition duration-300 flex-shrink-0 flex-grow-0 flex hover:opacity-80 rtl:pr-0 rtl:pl-3.5',
          clearIcon: 'bg-multiselect-remove bg-center bg-no-repeat w-2.5 h-4 py-px box-content inline-block',
          spinner: 'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 mr-3.5 animate-spin flex-shrink-0 flex-grow-0 rtl:mr-0 rtl:ml-3.5',
          inifite: 'flex items-center justify-center w-full',
          inifiteSpinner: 'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 animate-spin flex-shrink-0 flex-grow-0 m-3.5',
          dropdown: 'max-h-60 absolute -left-px -right-px bottom-0 transform translate-y-full  border-gray-300 -mt-px overflow-y-auto z-50 bg-white flex flex-col rounded-lg-b',
          dropdownTop: '-translate-y-full top-px bottom-auto rounded-lg-b-none rounded-lg-t',
          dropdownHidden: 'hidden',
          options: 'flex flex-col p-0 m-0 list-none  dark:bg-gray-700 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-red-500 dark:focus:border-red-500  bg-red-50 border border-red-500 text-red-900 placeholder-red-700   focus:ring-red-500 focus:border-red-500   dark:text-white  dark:bg-gray-700   dark:border-red-400',
          optionsTop: '',
          group: 'p-0 m-0',
          groupLabel: 'flex text-sm box-border items-center justify-start text-left py-1 px-3 font-semibold bg-gray-200 cursor-default leading-normal',
          groupLabelPointable: 'cursor-pointer',
          groupLabelPointed: 'bg-gray-300 text-gray-700',
          groupLabelSelected: 'bg-red-600 text-white',
          groupLabelDisabled: 'bg-gray-100 text-gray-300 cursor-not-allowed',
          groupLabelSelectedPointed: 'bg-red-600 text-white opacity-90',
          groupLabelSelectedDisabled: 'text-red-100 bg-red-600 bg-opacity-50 cursor-not-allowed',
          groupOptions: 'p-0 m-0',
          option: 'flex items-center justify-start box-border text-left cursor-pointer xs:text-sm sm:text-xs  leading-snug py-1 px-3',
          optionPointed: 'text-gray-800 bg-gray-100 dark:text-gray-300 dark:bg-gray-500',
          optionSelected: 'text-white bg-red-500',
          optionDisabled: 'text-gray-300 cursor-not-allowed',
          optionSelectedPointed: 'text-white bg-red-500 opacity-90',
          optionSelectedDisabled: 'text-red-100 bg-red-500 bg-opacity-50 cursor-not-allowed',
          noOptions: 'py-1 px-3 text-gray-600 bg-white text-left dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500  bg-red-50 border border-red-500 text-red-900 placeholder-red-700   focus:ring-red-500 focus:border-red-500   dark:text-white  dark:bg-gray-700   dark:border-red-400',
          noResults: 'py-1 px-3 text-gray-600 bg-white text-left dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500  bg-red-50 border border-red-500 text-red-900 placeholder-red-700   focus:ring-red-500 focus:border-red-500   dark:text-white  dark:bg-gray-700   dark:border-red-400',
          fakeInput: 'bg-transparent absolute left-0 right-0 -bottom-px w-full h-px border-0 p-0 appearance-none outline-none text-transparent',
          spacer: 'h-6 py-px box-content',
      }
        : {          
          /* container: 'relative mx-auto w-full flex items-center h-6 py-3   px-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-lg-lg-lg justify-end box-border cursor-pointer border border-gray-300 rounded-lg-lg bg-white xs:text-sm sm:text-xs  leading-snug outline-none', */
          /*  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500 */
          container: 'xs:text-sm sm:text-xs  min-h-6 relative mx-auto w-full flex items-center justify-end box-border cursor-pointer  rounded-lg bg-white  border border-gray-300 leading-snug outline-none  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500',
          containerDisabled: 'cursor-default bg-gray-100',
          containerOpen: 'rounded-lg-b-none',
          containerOpenTop: 'rounded-lg-t-none',
          containerActive: 'ring-1 ring-blue-500 ',
          singleLabel: 'flex items-center h-6 max-w-full absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 pr-16 box-border rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
          singleLabelText: 'overflow-ellipsis overflow-hidden block whitespace-nowrap max-w-full',
          multipleLabel: 'flex items-center h-6 absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
          search: 'w-full absolute inset-0 outline-none focus:ring-0 appearance-none box-border border-0 xs:text-sm sm:text-xs  font-sans bg-white rounded-lg pl-3.5 rtl:pl-0 rtl:pr-3.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-100  dark:focus:ring-blue-500 dark:focus:border-blue-500',
          tags: 'flex-grow flex-shrink flex flex-wrap items-center pl-2 rtl:pl-0 rtl:pr-2',
          tag: 'xs:text-sm sm:text-xs  font-semibold py-0.5 pl-2 rounded-lg mr-1  flex items-center whitespace-nowrap rtl:pl-0 rtl:pr-2 rtl:mr-0 rtl:ml-1 bg-blue-500 text-white  dark:bg-gray-600  dark:text-white ',
          tagDisabled: 'pr-2 opacity-50 rtl:pl-2',
          tagRemove: 'flex items-center justify-center p-1 mx-0.5 rounded-lg-sm hover:bg-black hover:bg-opacity-10 group',
          tagRemoveIcon: 'bg-multiselect-remove bg-center bg-no-repeat opacity-90 inline-block w-3 h-3 group-hover:opacity-60',
          tagsSearchWrapper: 'inline-block relative mx-1 mb-1 flex-grow flex-shrink h-full',
          tagsSearch: 'absolute inset-0 border-0 outline-none focus:ring-0 appearance-none p-0 xs:text-sm sm:text-xs  font-sans box-border w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500',
          tagsSearchCopy: 'invisible whitespace-pre-wrap inline-block h-px',
          placeholder: 'flex items-center h-6 absolute left-0 top-0 pointer-events-none bg-transparent leading-snug pl-3.5 text-gray-900 dark:text-gray-300 rtl:left-auto rtl:right-0 rtl:pl-0 rtl:pr-3.5',
          caret: 'bg-multiselect-caret bg-center bg-no-repeat w-2.5 h-4 py-px box-content mr-3.5 relative z-10 opacity-50 flex-shrink-0 flex-grow-0 transition-transform transform pointer-events-none rtl:mr-0 rtl:ml-3.5',
          caretOpen: 'rotate-180 pointer-events-auto',
          clear: 'pr-3.5 relative z-10 opacity-90 transition duration-300 flex-shrink-0 flex-grow-0 flex hover:opacity-80 rtl:pr-0 rtl:pl-3.5',
          clearIcon: 'bg-multiselect-remove bg-center bg-no-repeat w-2.5 h-4 py-px box-content inline-block',
          spinner: 'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 mr-3.5 animate-spin flex-shrink-0 flex-grow-0 rtl:mr-0 rtl:ml-3.5',
          inifite: 'flex items-center justify-center w-full',
          inifiteSpinner: 'bg-multiselect-spinner bg-center bg-no-repeat w-4 h-4 z-10 animate-spin flex-shrink-0 flex-grow-0 m-3.5',
          dropdown: 'max-h-60 absolute -left-px -right-px bottom-0 transform translate-y-full  border-gray-300 -mt-px overflow-y-auto z-50 bg-white flex flex-col rounded-lg-b',
          dropdownTop: '-translate-y-full top-px bottom-auto rounded-lg-b-none rounded-lg-t',
          dropdownHidden: 'hidden',
          options: 'flex flex-col p-0 m-0 list-none  dark:bg-gray-700  dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500  bg-blue-50 border border-blue-500 text-blue-900 placeholder-blue-700   focus:ring-blue-500 focus:border-blue-500   dark:text-gray-300  dark:bg-gray-700   dark:border-blue-400',
          optionsTop: '',
          group: 'p-0 m-0',
          groupLabel: 'flex text-sm box-border items-center justify-start text-left py-1 px-3 font-semibold bg-gray-200 cursor-default leading-normal',
          groupLabelPointable: 'cursor-pointer',
          groupLabelPointed: 'bg-gray-300 text-gray-700',
          groupLabelSelected: 'bg-blue-600 text-white',
          groupLabelDisabled: 'bg-gray-100 text-gray-300 cursor-not-allowed',
          groupLabelSelectedPointed: 'bg-blue-600 text-white opacity-90',
          groupLabelSelectedDisabled: 'text-blue-100 bg-blue-600 bg-opacity-50 cursor-not-allowed',
          groupOptions: 'p-0 m-0',
          option: 'flex items-center justify-start box-border text-left cursor-pointer xs:text-sm sm:text-xs  leading-snug py-1 px-3',
          optionPointed: 'text-gray-800 bg-gray-100 dark:text-gray-300 dark:bg-gray-500',
          optionSelected: 'text-white bg-blue-500',
          optionDisabled: 'text-gray-300 cursor-not-allowed',
          optionSelectedPointed: 'text-white bg-blue-500 opacity-90',
          optionSelectedDisabled: 'text-blue-100 bg-blue-500 bg-opacity-50 cursor-not-allowed',
          noOptions: 'py-1 px-3 text-gray-600 bg-white text-left dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500',
          noResults: 'py-1 px-3 text-gray-600 bg-white text-left dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-blue-500 dark:focus:border-blue-500',
          fakeInput: 'bg-transparent absolute left-0 right-0 -bottom-px w-full h-px border-0 p-0 appearance-none outline-none text-transparent',
          spacer: 'h-6 py-px box-content',
        }"  
        v-bind="{ ...$attrs, class: null}" 
      />

      <p v-if="error" class="mt-2 xs:text-sm sm:text-xs  text-red-600 dark:text-red-500"><span class="font-bold">{{ error }}</span></p>
    </div>
</template>

<script>
  import { v4 as uuid } from 'uuid'
  import Multiselect from '@vueform/multiselect'

  export default {
    inheritAttrs: false,
    props : {
      id: {
        type: String,
        default() {
          return `text-input-${uuid()}`
        },
      },
      mode: {
        type: String,
        default() {
          return "multiple"
        },
      },
      options : Array,
      error : String,
      placeholder : String
    },
    components: {
      Multiselect
    },
    methods : {
    
      focus() {
        this.$refs.input.focus()
      },

      clear() {
        this.$refs.input.clear()
      },
    }
  }
</script>
