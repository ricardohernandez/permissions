import { defineStore } from 'pinia'

export const useMainStore = defineStore('store', {
  state: () => ({
    dark: Boolean,
    /*  backgroundColor: "",
     textColor: "", */
    colors: {},
  }),
  getters: {
    getDark() {
      return this.dark
    },
    /* getBackgroundColor() {
      return this.backgroundColor
    },
    getTextColor() {
      return this.textColor
    }, */
    getColors() {
      return this.colors
    },
  },
  actions: {
    changeDarkMode(val) {
      this.dark = val
      if (val == true) {
        this.colors = {
          "bgcolor": "#0F172A",
          "textColor": "#F1F3F4",
          "color1": "#EA580C",
          "color2": "#3730A3",
          "color3": "#374151",
        }

        /* this.backgroundColor = "#0F172A"
        this.textColor = "#F1F3F4"
        this.optionsColor = ["#EA580C", "#3730A3", "#374151"] */
      } else {
        this.colors = {
          "bgcolor": "#FFFFFF",
          "textcolor": "#1D57DA",
          "color1": "#EA580C",
          "color2": "#3730A3",
          "color3": "#374151",
        }

        /*   this.backgroundColor = "#FFFFFF"
        this.textColor = "#1D57DA"
        this.optionsColor = ["#EA580C", "#3730A3", "#374151"] */
      }
    },

    /* changeDarkMode2() {
      this.dark = !this.dark
    },
    */


  },


})