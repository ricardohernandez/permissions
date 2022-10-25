<template>
  <Line
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
    ref="line"
  /> 
</template>

<script>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  PointElement,
  CategoryScale,
  Filler,
   } from 'chart.js'

ChartJS.register(Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  PointElement,
  Filler,
  CategoryScale)

export default {
  name: 'LineChart',
  components: { Line },
  props: {
    chartId: {
      type: String,
      default: 'line-chart'
    },
    /* chartData: Array, */
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
  data() {
    return {
      chartOptions: {
            maintainAspectRatio: false,
            legend: {
                display: false,
            },
            tooltips: {
                enabled: false,
            },
            elements: {
                point: {
                    radius: 0
                },
            },
            scales: {
                x: {
                    display: false,
                    grid: {
                        display:false
                    },
                    scaleLabel: false,
                    ticks: {
                        display: false
                    }
                },
                y: {
                    display: false,
                    grid: {
                     display:false
                    },
                    scaleLabel: false,
                    ticks: {
                        display: false,
                        suggestedMin: 0,
                        suggestedMax: 10
                    }
                }
            },
            plugins: {
                filler: {
                    propagate: true
                },
                title: {
                    display: false,
                },
                datalabels: {
                    display:  false,
                },
                legend: {
                    display:  false,
                },
            
           },
        },
      chartData : {
        labels: [1, 2, 1, 3, 5, 4, 7],
        datasets: [
            {
                backgroundColor: "rgba(101, 116, 205, 0.2)",
                borderColor: "rgba(101, 116, 205, 0.8)",
                borderWidth: 2,
                fill : true, 
                datalabels:{
                    title : null,
                },
                lineTension : 0.25,
                data: [1, 2, 1, 3, 5, 4, 7],
            },
        ],
    },

    }
  }
}
</script>