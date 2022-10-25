<template>
  <Bar
    v-if="loaded"
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="myStyles"
    :width="width"
    :height="height"
    ref="bar"
  /> 
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import ChartDataLabels from 'chartjs-plugin-datalabels';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale,ChartDataLabels)

export default {
  name: 'BarChart',
  components: { Bar},
  props: {
    chartId: {
      type: String,
      default: 'bar-chart'
    },
    chartData: {
      type: Object,
    },
    getCanvasData: {
        type: Boolean,
        default: false
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: 400
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Object,
      default: () => {}
    }
  },
  computed: {
    myStyles () {
      return {
        position: 'relative',
      }
    },
  },
  data() {
    return {
      loaded: true,
      info:{},
      img:"",
      chartOptions : {
        maintainAspectRatio: false,
        responsive: true,
        onClick : this.ClickHandler,
        scales: {
            "y-active": {
              stacked:true,
              position:"left",
              /* title: {
                display: false,
                text: ''
              }, */
              grid: {
                borderDash: [3],
                borderDashOffset: [3],
                drawBorder: false,
               /*  color: "rgba(255, 255, 255, 0.15)", */
                zeroLineColor: "rgba(33, 37, 41, 0)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
              },
            },

             "y-perc": {
              position:"right",
              /* title: {
                display: false,
                text: ''
              }, */
              grid: {
               display:false
              },

              
            },

            x :{
              stacked:true,
              grid: {
               display:false
              },
              ticks: {
                /* backdropColor : "green", 
                backdropPadding:1,
                color:"green", 
                padding:1, 
                showLabelBackdrop:false,
                textStrokeColor:"green",  */
              }, 
            },

        },
        plugins: {
          datalabels: {
            color:  'white',
            textAlign: "center",
            formatter: function(value, index, values) {
              if(value >0 ){
                  value = value.toString();
                  value = value.split(/(?=(?:...)*$)/);
                  value = value.join(',');
                  return value;
              }else{
                  value = "";
                  return value;
              }
            },
            font: {
              size: 11
            }
          },
          legend: {
            align: "end",
            position: "bottom",
          },
          title: {
            display: false,
            text: "",
          },
          tooltips: {
            mode: "index",
            intersect: false,
          },
          hover: {
            mode: "nearest",
            intersect: true,
          },
        },
      },
    }
  },
  watch: {
      getCanvasData : {
          handler : function(){
           /*  console.log(this.getCanvasData) */
            this.img = this.$refs.bar.chart.canvas.toDataURL('image/png')
            this.$emit("downloadChartImg",this.img);
          },
          deep : true
      }
  },   
  
  methods:{
    ClickHandler(evt , array){
      const arr = array
      if(arr[0]!=undefined){
        const data = {
          x : evt.chart.data.labels[array[0].index][0],
          y : array[0].element.$context.raw,
          label : array[0].element.$context.dataset.label
        }

        this.info = data
        
        if(this.info.label!="Porc"){
          this.$emit("showViewModal",this.info);
        }
      }
    },

    getCanvasImg(evt){
      const data = "data"
      console.log(data)
      this.$emit("dataCanvasImg",data);
    }

    
  }


}
</script>