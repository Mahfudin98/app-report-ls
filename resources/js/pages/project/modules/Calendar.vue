<script>
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGridWeek from "@fullcalendar/timegrid";
import listWeek from "@fullcalendar/list";
import {
    mapActions,
    mapState
} from "vuex";
export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    created() {
        this.getReportWebs().then(res => {
            var length = res.data.length;
            var array = res.data;
            for (let i = 0; i < length; i++) {

                var arrTotal = array[i].total;
                var arrDate = array[i].date;
                var arrUrl = array[i].url;

                this.calendarOptions.events.push({
                    title: "URL : " + arrUrl,
                    date: arrDate
                }, {
                    title: 'Total : ' + arrTotal + ' view',
                    start: arrDate + 'T00:00:00',
                    end: arrDate + 'T23:59:59'
                })
            }

        });
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridWeek, listWeek, interactionPlugin],
                timeZone: 'UTC',
                themeSystem: 'bootstrap',
                dateClick: this.handleDateClick,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                // weekNumbers: true,
                // dayMaxEvents: true, // allow "more" link when too many events
                events: []
            },
        }
    },
    computed: {
        ...mapState("reportWeb", {
            reportWebs: state => state.reportWebs
        }),

        viewTitle() {
            var result = this.reportWebs.data;
            var title = Object.keys(result).map(function (key) {
                return parseInt(result[key].total);
            });
            return title;
        },
        viewDate() {
            var result = this.reportWebs.data;
            var date = Object.keys(result).map(function (key) {
                return result[key].date
            });

            return date[0];
        },
    },
    watch: {

    },
    methods: {
        ...mapActions("reportWeb", ["getReportWebs"]),
        handleDateClick: function (arg) {
            this.$router.push("/cs-report/" + arg.dateStr)
        }
    }
};
</script>
<template>
<FullCalendar :options="calendarOptions" />
</template>
