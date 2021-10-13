<script>
import { Bar } from "vue-chartjs";

export default {
    extends: Bar,
    props: ["data", "options", "labels"],
    mounted() {
        this.barRenderChart();
    },
    watch: {
        data: {
            handler() {
                this._data._chart.destroy();
                this.barRenderChart();
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
        barRenderChart() {
            var length = this.data.length;
            var array = this.data;

            // Create new arrays to store the data
            var ratioArray = [];
            var labelsArray = [];

            for ( var i = 0; i < length; i++ ) {
            // Then push our data to the new arrays
            labelsArray.push(array[i] ? array[i].labels : '');
            ratioArray.push(array[i] ? array[i].total : '');
            }
            this.renderChart(
                {
                    labels: labelsArray,
                    datasets: [
                        {
                            label: "Data Omset",
                            data: ratioArray,
                            backgroundColor: this.colorBG,
                            // borderColor: [
                            //     "rgba(255, 99, 132, 1)",
                            //     "rgba(54, 162, 235, 1)",
                            //     "rgba(255, 206, 86, 1)"
                            // ],
                            borderWidth: 1
                        }
                    ]
                },
                this.options
            );
        }
    }
};
</script>
