<template>
  <Line
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
    ref="lin"/> 
  <div></div>
</template>

<script>
import { Line } from 'vue-chartjs'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineElement,
  CategoryScale,
  LinearScale,
  PointElement,
  Filler
  
} from 'chart.js'
import ChartDataLabels from 'chartjs-plugin-datalabels';

ChartJS.register(Title, Tooltip, Legend, LineElement, LinearScale, CategoryScale, PointElement, Filler,ChartDataLabels)

export default {
  components: { Line },
  props: {
    chartId: {
      type: String,
      default: 'line-chart'
    },
    url: {
      type: String,
      default: ''
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
        /* position: 'relative', */
      }
    }
  },
  data() {
    return {
      loaded: true,
      chartData:{},
       /* chartData: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
          {
            label: 'Data 1',
            borderColor: '#3730A3',
            pointBackgroundColor: 'white',
            borderWidth: 2,
            fill: true,
            pointBorderColor: 'rgba(55, 48, 163, .7)',
            backgroundColor:'rgba(55, 48, 163, .7)',
            backgroundColor: (ctx) => {
              const canvas = ctx.chart.ctx;
              const gradient = canvas.createLinearGradient(0,0,0,510);
              gradient.addColorStop(0, 'red');
              gradient.addColorStop(.5, 'orange');
              gradient.addColorStop(1, 'yellow');
              return gradient;
            },
            lineTension: 0.25,
            data: [40, 39, 10, 40, 39, 80, 40]
          }
        ]
      }, */
      chartOptions: {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          align: "end",
          position: "bottom",
        },
        scales: {
          x: 
            {
              ticks: {
                fontColor: "rgba(255,255,255,.7)",
              },
              display: true,
              scaleLabel: {
                display: false,
                labelString: "Month",
                fontColor: "white",
              },
              grid: {
                display: false,
              },
            },
          y:{
              ticks: {
                fontColor: "rgba(255,255,255,.7)",
              },
              display: true,
              scaleLabel: {
                display: false,
                labelString: "Value",
                fontColor: "white",
              },
              grid: {
                borderDash: [3],
                borderDashOffset: [3],
                drawBorder: false,
                //color: "rgba(255, 255, 255, 0.15)",
                zeroLineColor: "rgba(33, 37, 41, 0)",
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2],
              },
            },
        },
        plugins: {
          filler: {
              propagate: true
          },
          title: {
            display: false,
            text: (ctx) =>{ 
              'Fill: ' + ctx.chart.data.datasets[0].fill
            }
          },
          datalabels: {
            color:  'grey',
            align : "top",
            font: {
              size: 11
            }
          },
          legend: {
            align: "end",
            position: "bottom",
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
  async mounted () {
    /*console.log(this.$refs.lin.chart.data.datasets[0].fill)
     ctx.chart.data.datasets[0].fill */
    this.loaded = false
    const url = this.url
    try {
      axios.get(this.route(url)).then((response) => {
        this.chartData = response.data
        this.loaded = true
        this.$nextTick(() => { 
          /* console.log(this.$refs.lin.chart) */
        })
      })
    } catch (e) {
      console.error(e)
    }
  },

}
</script>