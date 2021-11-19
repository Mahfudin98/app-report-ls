<script>
    import { Line } from 'vue-chartjs'

    export default {
        extends: Line,
        props: ['data', 'options', 'labels'],
        mounted() {
            this.lineRenderChart()
        },
        watch: {

            data: {
                handler() {
                    this._data._chart.destroy()
                    this.lineRenderChart()
                },
                deep: true
            }
        },
        computed: {
            colorBG() {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++ ) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            },
        },
        methods: {
            lineRenderChart() {

                this.renderChart({
                    labels: this.labels,
                    datasets: [{
                        label: 'Data All Omset',
                        data: this.data,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                }, this.options)
            }
        }
    }
</script>
