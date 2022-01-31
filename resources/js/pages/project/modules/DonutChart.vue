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
                labelsArray.push(array[i] ? array[i].name : "");
                ratioArray.push(array[i] ? array[i].total : "");
            }
            this.renderChart(
                {
                    labels: labelsArray,
                    datasets: [
                        {
                            // labels: labelsArray,
                            data: ratioArray,
                            backgroundColor: [
                                window.theme.warning,
                                window.theme.primary
                            ],
                            borderColor: window.theme.white,
                            borderWidth: 5
                        }
                    ]
                },
                this.options
            );
        }
    }
};
</script>
