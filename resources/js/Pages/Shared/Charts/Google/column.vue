<template>
  <GChart
      :settings="{ packages: ['corechart', 'table', 'map'] }"
      type="ColumnChart"
      :data="chartData"
      :options="chartOptions"
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
    var self = this;
    return {
   
      chartOptions : {},
       chartEvents: {
        click: (e) => {    
           let idx = e.targetID.match(/\d+/g);      
           idx = Number(idx[0])
           console.log(e)

        /*   const table = this.$refs.gChart.chartObject;
          const selection = table.getSelection();        */   
         /*  const onSelectionMeaasge = selection.length !== 0 ? 'row was selected' : 'row was diselected'
          alert(onSelectionMeaasge); */
        }
      }
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
        /* 
        animation: {
          duration: 1000,
          easing: "out"
        }, */

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
      }
    }
  }
}
</script>