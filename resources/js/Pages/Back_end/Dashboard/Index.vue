<template>
    <app-layout title="Dashboard">
        <div class="w-full">
            <div class="overflow-hidden  bg-gray-50  dark:border-gray-600 dark:bg-slate-800 p-2">
                <!-- CARDS CHART-->
               
                    <div class="grid xs:grid-cols-2  sm:grid-cols-2  md:grid-cols-4 lg:grid-cols-4 gap-4 my-2">
                        <div class="flex-col w-full bg-white  dark:bg-slate-900 flex rounded-2xl ">
                            <div class=" bg-white relative overflow-hidden rounded-2xl  dark:bg-slate-900">
                                <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                    <h2 class="text-gray-900 dark:text-gray-300 uppercase text-base font-semibold"> Users </h2>
                                    <h3 class="text-xl text-gray-900 dark:text-gray-300 font-semibold leading-tight my-3">3,682</h3>
                                    <p class="text-xs text-green-500 leading-tight">▲ 57.1%</p>
                                </div>
                                <div class="absolute bottom-0 inset-x-0">
                                    <cardChart height="70"/>
                                </div>
                            </div>
                        </div>

                        <div class="flex-col w-full bg-white  dark:bg-slate-900 flex rounded-2xl">
                            <div class=" bg-white relative overflow-hidden rounded-2xl  dark:bg-slate-900">
                                <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                    <h2 class="text-gray-900 dark:text-gray-300 uppercase text-base font-semibold"> Users </h2>
                                    <h3 class="text-xl text-gray-900 dark:text-gray-300 font-semibold leading-tight my-3">3,682</h3>
                                    <p class="text-xs text-green-500 leading-tight">▲ 57.1%</p>
                                </div>
                                <div class="absolute bottom-0 inset-x-0">
                                    <cardChart height="70"/>
                                </div>
                            </div>
                        </div>

                    </div>

                <!-- CHARTS-->
                    <div class="mt-4">
                        <div class="grid xs:grid-cols-1  sm:grid-cols-1  md:grid-cols-2 lg:grid-cols-2 gap-4 ">
                            <!-- BAR -->
                                <div class="m-auto w-full lg:col-span-1 rounded-2xl  bg-white  dark:bg-slate-900">
                                    <div class="rounded-t mb-0 px-1 py-1 bg-transparent">
                                        <div class="flex flex-wrap items-center">
                                            <div class="relative w-full max-w-full  p-2">
                                                <h6 class="uppercase text-gray-400 mb-1 text-xs font-semibold">
                                                    {{ __('users_title')}}
                                                </h6>
                                                <div class="grid xs:grid-cols-3  lg:grid-cols-4 gap-2">
                                                    <div class="m-auto w-full xs:col-span-3 lg:col-span-1">
                                                        <h2 class="text-gray-900 dark:text-gray-300 text-xl font-semibold">
                                                            {{ __('total_by_month')}}
                                                        </h2>
                                                    </div>
                                                    <div class="m-auto w-full xs:col-span-1 lg:col-span-1">
                                                        <div class="relative block w-full"> 
                                                            <month-input v-model="filters.date_from"  class="mb-1 w-full"/>
                                                        </div>
                                                    </div>
                                                    <div class="m-auto w-full xs:col-span-1 lg:col-span-1">
                                                        <div class="relative block w-full "> 
                                                            <month-input v-model="filters.date_to"  class="mb-1 w-full"/>
                                                        </div>
                                                    </div>
                                                    <div v-if="$can('dashboard.export')" class="m-auto w-full  xs:col-span-1 lg:col-span-1">
                                                        <jet-dropdown align="right" width="48" >
                                                            <template #trigger>
                                                                <button type="button" class="w-full block font-semibold rounded-lg xs:text-sm sm:text-xs  px-2 py-1 -mt-1 mx-auto items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300  dark:focus:ring-blue-700 dark:hover:bg-blue-800 dark:hover:text-white dark:bg-blue-700 dark:text-gray-100 dark:border-blue-800 transition">
                                                                    <span class="">{{__('user_filter_export')}}</span>
                                                                    <svg class="inline-block  w-5 h-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                    </svg>
                                                                </button>
                                                            </template>

                                                            <template #content>
                                                            <jet-dropdown-link as="button" @click="exportExcel()">
                                                                Excel 
                                                            </jet-dropdown-link>

                                                            <jet-dropdown-link  @click="canvasDataHandler" as="button">
                                                                JPG
                                                            </jet-dropdown-link>
                                                            
                                                            </template>
                                                        </jet-dropdown>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-1 flex-auto">
                                        <div class="relative">
                                            <barChartjs 
                                                :chartData="barJSChartData"
                                                :getCanvasData="getCanvasData"
                                                @downloadChartImg="downloadChartImg"
                                                @showViewModal="showViewModal"/>
                                            <barChartModal
                                                :isModalVisible="isModalVisible"
                                                :modal_data="modal_data"
                                                @close="closeViewModal" /> 
                                        </div>
                                    </div>
                                </div>

                            <!-- LINE -->
                                <div class="m-auto w-full lg:col-span-1 rounded-2xl  bg-white  dark:bg-slate-900">
                                    <div class="rounded-t mb-0 px-1 py-1 bg-transparent">
                                        <div class="flex flex-wrap items-center">
                                            <div class="relative w-full max-w-full  p-2">
                                                <h6 class="uppercase text-gray-400 mb-1 text-xs font-semibold">
                                                    OVERVIEW
                                                </h6>
                                                <h2 class="text-gray-900 dark:text-gray-300 text-xl font-semibold">
                                                    Sales value
                                                </h2>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-1 flex-auto">
                                        <div class="relative">
                                                <lineChartjs url="lineJSChartData" />
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                <!--  <div class="grid xs:grid-cols-1  sm:grid-cols-1  md:grid-cols-3 lg:grid-cols-4">
                    <div class="m-auto w-full lg:col-span-1">
                        <comboChart 
                            :chartData="comboChartData"
                            title="combo titulo"
                            :colors="colors"  
                        />
                    </div>

                    <div class="m-auto w-full lg:col-span-1">
                        <pieChart 
                            :chartData="pieChartData"
                            title="pietitulo"
                            :colors="colors"  
                        />
                    </div>

                    <div class="m-auto w-full lg:col-span-1">
                        <columnChart 
                            :chartData="columnChartData"
                            title="column titulo"
                            :colors="colors"  
                        />
                    </div>

                    <div class="m-auto w-full lg:col-span-1">
                        <barChart 
                            :chartData="barChartData"
                            title="bar titulo"
                            :colors="colors"  
                        />
                    </div>
                </div> --> 
            </div>
        </div>
    </app-layout>
</template>

<script>
    /* import { defineComponent ,ref ,toRefs,reactive,watch,provide,inject,onMounted} from 'vue' */
    import { defineComponent } from 'vue'
    import { useMainStore  } from '@/Stores/useMainStore'
    import { mapState } from 'pinia'
    import { pickBy } from 'lodash'
    import { debounce } from 'lodash'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import pieChart from 'Shared/Charts/Google/pie.vue'
    import barChart from 'Shared/Charts/Google/bar.vue'
    import columnChart from 'Shared/Charts/Google/column.vue'
    import comboChart from 'Shared/Charts/Google/combo.vue'
    import barChartjs from 'Shared/Charts/Chartjs/barjs.vue'
    import lineChartjs from 'Shared/Charts/Chartjs/line.vue'
    import cardChart from 'Shared/Charts/Chartjs/cardChart.vue'
    import pieChartjs from 'Shared/Charts/Chartjs/pie.vue'
    import MonthInput from 'Shared/Input/MonthInput.vue'
    import barChartModal from './barChartModal.vue'
    import JetDropdown from '@/Jetstream/Dropdown.vue'
    import JetDropdownLink from '@/Jetstream/DropdownLink.vue'

    export default defineComponent({
        components: {
            AppLayout,pieChart,barChart,comboChart,columnChart,barChartjs,lineChartjs,pieChartjs,
            MonthInput,barChartModal,JetDropdown,JetDropdownLink,cardChart
        },
        props:{
            filters :{
                type : Object,
                default : () => []
            }
        },
        data(){
            return{
                isModalVisible : false,
                getCanvasData: false,
                info_chart : {},
                modal_data : [],
                pieChartData : [],
                barChartData : [],
                comboChartData : [],
                columnChartData : [],
                barJSChartData : [],
                lineJSChartData : [],
                filters : {
                    date_from : this.filters["date_from"],
                    date_to : this.filters["date_to"]
                }
            }
        },
        computed: {
            ...mapState(useMainStore, ['dark','colors'])
        },
        watch: {
            filters : {
                handler : debounce(function(){
                    let params = pickBy(this.filters)
                    axios.get('barJSChartData',{params:params}).then((response) => {
                        if(response.data.res=="ok"){
                            this.barJSChartData = response.data.array
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: response.data.msg
                            })
                        }
                    })
                },10),
                deep : true
            }
        },    
        mounted(){
            axios.get('barJSChartData',{params:this.filters}).then((response) => {
                if(response.data.res=="ok"){
                    this.barJSChartData = response.data.array
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: response.data.msg
                    })
                }
            })
            
            /* axios.get(this.route('lineJSChartData')).then((response) => {
                this.lineJSChartData = response.data
            })

            axios.get(this.route('pieChartData')).then((response) => {
                this.pieChartData = response.data
            })

            axios.get(this.route('barChartData')).then((response) => {
                this.barChartData = response.data
            })

            axios.get(this.route('comboChartData')).then((response) => {
                this.comboChartData = response.data
            })

            axios.get(this.route('columnChartData')).then((response) => {
                this.columnChartData = response.data
            }) */

        },
        methods:{
            showViewModal(info){
                this.info_chart = info
                axios.get('barDataChart',{params:this.info_chart}).then((response) => {
                    this.modal_data = response.data.array
                    this.modal_data["info"] = response.data.info
                    this.isModalVisible = true;
                })
            },
            closeViewModal(){
                this.isModalVisible = false;
            },
            downloadChartImg(image){
                const linkSource = image;
                const downloadLink = document.createElement("a");
                downloadLink.href = linkSource;
                downloadLink.download = "chart.png";
                downloadLink.click();
            },
            canvasDataHandler(){
                this.getCanvasData = !this.getCanvasData
            },
            exportExcel(){
                 window.location.href = route('excelChart' , this.filters)
            }
        }
        
       /*  setup() {

            const chartData = ref([])
            const state = reactive({
                textColor: "",
                backgroundColor: "",
            });

            const store = useMainStore()
            const { dark, getter} = storeToRefs(store)
      
            onMounted(() => {
                if(getter.value){
                    state.backgroundColor = "#0F172A"
                    state.textColor = "#F3F4EF"
                }else{
                    state.backgroundColor = "#FFFFFF"
                    state.textColor = "#1D57DA"
                }
            })

            watch(getter, () => {
                if(getter.value){
                    state.backgroundColor = "#0F172A"
                    state.textColor = "#F3F4EF"
                }else{
                    state.backgroundColor = "#FFFFFF"
                    state.textColor = "#1D57DA"
                }
            })

            function getChartData() {
                axios.get('getUserData').then((response) => {
                    chartData.value = response.data
                })
            }

            getChartData()

            return {
                ...toRefs(state),
                getChartData,
                chartData,
                store,
                dark,
                getter,
            }
        }, */
     })

</script>


