<template>
    <div class="card">
        <div class="card-body">
            <calender />
        </div>
    </div>
</template>
<script>
import PageLoader from "../../../../../components/PageLoader.vue";
import { mapActions, mapState } from "vuex";
import DatePicker from "vue2-datepicker";
import VueMomentsAgo from "vue-moments-ago";
import Calender from "./Calendar.vue";
import moment from "moment";
export default {
    components: {
        Calender,
        PageLoader
    },
    name: "DataReportCS"
};
</script>
