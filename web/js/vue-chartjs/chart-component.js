Vue.component('line-chart', {
    extends: VueChartJs.Bar,
    props: ['chartData','options'],
    mounted () {
        this.renderChart(
            this.chartData,
            this.options
        )
    }
})