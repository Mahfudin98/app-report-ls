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
            var letters = "0123456789ABCDEF".split("");
            var color = "#";
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
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
                            label: "Data Product",
                            data: ratioArray,
                            backgroundColor: labelsArray.map(
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
