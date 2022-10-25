<template>
  <GChart
      :settings="{ packages: ['corechart', 'table', 'map'] }"
      type="ComboChart"
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
        /* console.log(this.backgroundColor+" | "+this.colors.textColor) */
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
        colors:[colors.color1,colors.color2,colors.color3],
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
        },
        vAxis: {
          textStyle:{
            color: colors.textColor,
            bold:true,
            fontSize: 10
          },
        },
        vAxes: {
          0: 
          {
            textStyle:{
              color: colors.textColor,
              bold:true,
              fontSize: 11
            },
            gridlines: {
              color: 'transparent',
              count:3,
              fontSize: 10,
              bold:false,

            },
            viewWindowMode:'explicit',
          },
          1: 
          {
            textStyle:{
                color: colors.textColor,
                bold:false,
                fontSize: 11
            },
            gridlines: {
              color: 'transparent',
              count:3,
            },
          }
        },
        seriesType:'bars',
        series: {
            0: {
                type: 'line',
                color:  colors.color1,
                curveType: 'function',
                lineWidth: 2,
                pointSize: 5,
                pointShape: 'square',
                targetAxisIndex:0,
                annotations: {
                    stem:{
                        length: 4
                    },   
                }
                },
            1: {
                type: 'bars',
                color: colors.color2,
                targetAxisIndex:1,
                annotations: {
                    style: 'line',
                        textStyle: {
                        fontSize: 10,
                        color: colors.textColor,
                        strokeSize: 1,
                        auraColor: 'transparent'
                    },
                    alwaysOutside: false,  
                    stem:{
                        color: 'transparent',
                        length: 8
                    },   
                }
                },
            2: {
                type: 'bars',
                color:  colors.color3,
                targetAxisIndex:1,
                annotations: {
                    style: 'line',
                    textStyle: {
                        fontSize: 10,
                        color: colors.textColor,
                        strokeSize: 1,
                        auraColor: 'transparent'
                    },
                    alwaysOutside: false,  
                    stem:{
                        color: 'transparent',
                        length: 8
                    },   
                }
            }
        },
      }
    }
  }
}
</script>