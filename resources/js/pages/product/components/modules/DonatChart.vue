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

            for (var i = 0; i < length; i++) {
                // Then push our data to the new arrays
                labelsArray.push(array[i] ? array[i].labels : "");
                ratioArray.push(array[i] ? array[i].total : "");
            }
            this.renderChart(
                {
                    labels: labelsArray,
                    datasets: [
                        {
                            // label: ratioArray + "%",
                            data: ratioArray,
                            backgroundColor: [
                                "rgb(255, 215, 0)",
                                "rgb(54, 162, 235)",
                                "rgb(255, 99, 132)"
                            ],
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
