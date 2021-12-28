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
    methods: {
        barRenderChart() {
            this.renderChart(
                {
                    labels: this.labels,
                    datasets: [
                        {
                            label: "Data View Website",
                            data: this.data,
                            backgroundColor: 'rgb(75, 192, 192)',
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
