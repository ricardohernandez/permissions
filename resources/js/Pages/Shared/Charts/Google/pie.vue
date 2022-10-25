<template>
  <GChart
      :settings="{ packages: ['corechart', 'table', 'map'] }"
      type="PieChart"
      :data="chartData"
      :options="chartOptions"
      :resizeDebounce="500"
      @ready="onChartReady"
      :events="chartEvents"
      ref="gChart"
  />
</template>

<script>
import { GChart } from 'vue-google-charts';

export default {
  components:{
    GChart
  },
  props: {
    chartData: Array,
    colors: Object,
    title : String
  },
  data(){
    return {
      chartOptions : {},

      chartEvents: {
        click: (e,i) => {
          console.log(e);
          let idx = e.targetID.match(/\d+/g);
          if (idx && idx.length < 3) {
            idx = Number(idx[0]);
             console.log(idx);
          }
        },
      },

      /* select: (e) => {
        console.log(e);
      }, */

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

    onChartReady () {
    },

    setOptions(colors){
      this.chartOptions = {
        is3D: true,
        /*  width: 500, */
        height: 300,
        colors:[colors.color2,colors.color3],
        fontName: 'Nunito',
        sliceVisibilityThreshold:0,
        format: 'short',
        isStacked: 'percent',
        pieSliceText: 'value',
        title: this.title,
        subtitle: '',
        chartArea:{
          left:30,
          right:30,
          bottom:30,
          top:53,
          width:"100%",
          height:"100%",
          backgroundColor: {
              fill: colors.bgcolor,
              fillOpacity: 0.1
          },
        },
        backgroundColor: {
            fill: colors.bgcolor,
            fillOpacity: 0.8
        },
        titleTextStyle: {
            color: colors.textColor,
            fontSize: 13, 
            fontWidth: 'normal',
            bold:true
        },
        legend: {
          position: 'labeled',
          alignment:'center',
          textStyle: {
            fontSize: 12,
            bold:true,
            color: colors.textColor
          }
        }, 
      }
    }
  }
}
</script>