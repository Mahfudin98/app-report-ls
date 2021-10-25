<template>
    <div class="rui-page-content">
        <div class="container-fluid">
            <calender/>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState } from "vuex";
import DatePicker from "vue2-datepicker";
import VueMomentsAgo from "vue-moments-ago";
import moment from "moment";
import Calender from "./module/Calendar.vue";
export default {
    components: { VueMomentsAgo, DatePicker, Calender },
    name: "DataReportCS",

    created() {
        this.getCsReports();
    },

    data() {
        return {
            range: {},
            search: {}
        };
    },

    computed: {
        ...mapState("csReport", {
            csReports: state => state.csReports
        })
    },

    watch: {
        search() {
            this.getCsReports(
                this.convert(this.search[0]) +
                    "+-+" +
                    this.convert(this.search[1])
            );
        }
    },

    methods: {
        convert(str) {
            var date = new Date(str),
                mnth = ("0" + (date.getMonth() + 1)).slice(-2),
                day = ("0" + date.getDate()).slice(-2);
            return [date.getFullYear(), mnth, day].join("-");
        },
        ...mapActions("csReport", ["getCsReports", "removePosition"]),
        deletePosition(id) {
            this.$swal({
                title: "Kamu Yakin?",
                text: "Tindakan ini akan menghapus secara permanent!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, Lanjutkan!"
            }).then(result => {
                if (result.value) {
                    this.removePosition(id);
                }
            });
        }
    }
};
</script>
