<template>
  <GChart
      :settings="{ packages: ['corechart', 'table', 'map'] }"
      type="BarChart"
      :data="chartData"
      :options="chartOptions"
      :resizeDebounce="500"
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
        isStacked: true,
        title: this.title,
        is3D: true,
        /* width: 500, */
        height: 300,
        colors:[colors.color2,colors.color3],
        fontName: 'Nunito',
        bar: {groupWidth: "50%"},
        chartArea:{
            left:30,
            right:30,
            bottom:30,
            top:70,
            width:"100%",
            height:"100%",
            backgroundColor: {
                fill: colors.bgcolor,
                fillOpacity: 0.9
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
            position:'top',
            alignment:'center',
            textStyle: {
              fontSize: 12,
              bold:true,
              color:colors.textColor
            }
        }, 
        annotations: {
            textStyle: {
              fontSize: 10,
              color: colors.textColor,
              auraColor: 'transparent'
            },
            alwaysOutside: false,  
            stem:{
              color: 'transparent',
              length: 8
            },   
        },
        
        hAxis: {
            textStyle:{
              color: colors.textColor, 
              fontSize: 12,
              bold:true,
            },
            gridlines: {
              color: 'transparent',
              count:10,
            },
        },
        vAxis: {
          textStyle:{
            color: colors.textColor,
            bold:true,
            fontSize: 10
          },
        },
      
      }
    }
  }
}
</script>