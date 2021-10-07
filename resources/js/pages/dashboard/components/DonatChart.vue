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
                            label: "Data Omset",
                            data: ratioArray,
                            backgroundColor: [
                                "rgba(255, 99, 132, 0.2)",
                                "rgba(54, 162, 235, 0.2)",
                                "rgba(255, 206, 86, 0.2)"
                            ],
                            borderColor: [
                                "rgba(255, 99, 132, 1)",
                                "rgba(54, 162, 235, 1)",
                                "rgba(255, 206, 86, 1)"
                            ],
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
