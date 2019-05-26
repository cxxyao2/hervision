import {Line} from 'vue-chartjs'

export default {
    extends: Line,
    props: {
        chartdata: {
            type: Object,
            default: null
        },
        options: {
            type: Ojbect,
            default: null
        }
    },
    mounted () {
        this.renderChart(this.chartdata, this.options)
    }
}
