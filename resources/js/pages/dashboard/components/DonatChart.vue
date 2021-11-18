<script>
import { Doughnut } from "vue-chartjs";

export default {
    extends: Doughnut,
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
    methods: {
        barRenderChart() {
            var length = this.data.length;
            var array = this.data;

            // Create new arrays to store the data
            var ratioArray = [];
            var labelsArray = [];

            for ( var i = 0; i < length; i++ ) {
            // Then push our data to the new arrays
            labelsArray.push(array[i] ? array[i].name : '');
            ratioArray.push(array[i] ? array[i].total_order : '');
            }
            this.renderChart(
                {
                    labels: labelsArray,
                    datasets: [
                        {
                            // label: ratioArray + "%",
                            data: ratioArray,
                            backgroundColor: ratioArray.map(
                                d =>
                                    "rgba(" +
                                    Math.floor(Math.random() * 255) +
                                    "," +
                                    Math.floor(Math.random() * 255) +
                                    "," +
                                    Math.floor(Math.random() * 255) +
                                    ", 0.8)"
                            ),
                            borderColor: "rgba(94, 119, 255, 1)",
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
