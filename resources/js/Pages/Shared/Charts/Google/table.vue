<template>
  <GChart
     :settings="{ packages: ['table'] }"
      type="Table"
      :data="chartData"
      :options="chartOptions"
      :events="chartEvents"
      ref="gChart"
  />
</template>

<script>
import { GChart } from "vue-google-charts";

export default {
  components:{
    GChart
  },
  props: {
    colors: Object,
    title : String
  },
  data(){
    return {
      chartData: [
        [
          { type: "string", label: "President", id: "President" },
          { type: "date", label: "From", id: "From" },
          { type: "date", label: "To", id: "To" }
        ],
        ["Washington", new Date(1789, 3, 30), new Date(1797, 3, 4)],
        ["Adams", new Date(1797, 2, 4), new Date(1802, 2, 4)],
        ["Jefferson", new Date(1801, 2, 4), new Date(1809, 2, 4)]
      ],

      chartOptions: {
        chart: {
          title: "Company Performance",
          subtitle: "Sales, Expenses, and Profit: 2014-2017"
        }
      },

       chartEvents: {
        click: (e) => {
          let idx = e.targetID.match(/\d+/g);
          console.log(idx);
          /* if (idx && idx.length < 3) {
            idx = Number(idx[0]);
            this.isFiltered ? this.allData() : this.filterChart(idx);
          } */
        },
      },
    }
  },
  mounted: function () {
     this.$watch(
      (vm) => [vm.colors],
      (val) => {
        this.setOptions(this.colors)
      },
      {
        immediate: true,
        deep: true,
      }
    );
  },
  methods:{

    setOptions(colors){
      this.chartOptions = {
       chart: {
          title: "Company Performance",
          subtitle: "Sales, Expenses, and Profit: 2014-2017"
        }
      }
    }
  }
}
</script>