<template>
    <apexchart type="bar" :options="chartOptions" :series="chartData" />
</template>

<script>
import VueApexCharts from 'vue3-apexcharts';

export default {
    name:'ApexGraph',
    components: {
        apexchart: VueApexCharts,
    },
    props: {
        data: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            chartData: [
                {
                    data: [],
                },
            ],
            chartOptions: {
                chart: {
                    height: 350,
                    type: 'bar',
                },
                xaxis: {
                    type: 'date',
                    title: {
                        text: 'Days',
                    },
                },
                yaxis: {
                    title: {
                        text: 'Views Count',
                    },
                },
                colors: ['#2d3436'],
            },
        };
    },
    watch: {
        data: {
            handler() {
                this.chartData = this.data;
            },
            immediate: true
        }
    }
};
</script>
