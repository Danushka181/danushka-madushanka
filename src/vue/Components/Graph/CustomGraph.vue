<template>
    <div class="chart">
        <div class="custom-chart">
            <div class="custom-chart__inner">
                <div class="bars-list">
                    <div
                        v-for="(point, index) in chartData[0].data"
                        :key="index"
                        :style="{ height: point.y / maxY * chartHeight + 'px' }"
                        class="single-bar"
                    >
                        <span class="bar-value">{{point.y}}</span>
                        <span class="bar-label">{{point.x}}</span>
                    </div>
                </div>
                <span class="y-label">Views Count</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CustomGraph",
    props: {
        data: {
            type: Array,
            required: true,
        },
        chartWidth: {
            type: Number,
            default: 800,
        },
        chartHeight: {
            type: Number,
            default: 300,
        },
    },
    data() {
        return {
            barWidth: 50,
            barMargin: 10,
        };
    },
    computed: {
        chartData() {
            return this.data;
        },
        maxY() {
            const max = Math.max(
                ...this.chartData[0].data.map((point) => point.y)
            );
            return max === 0 ? 1 : max;
        },
    },
};
</script>
