<script>
import {
    mapActions,
    mapState
} from "vuex";
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGridWeek from "@fullcalendar/timegrid";
import listWeek from "@fullcalendar/list";

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    created() {
        this.getCsReports().then(res => {
            var length = res.data.length;
            var array = res.data;
            for (let i = 0; i < length; i++) {

                var arrChat = array[i].chat;
                var arrDate = array[i].date;
                var arrTransaksi = array[i].transaksi;
                var arrTotal = array[i].total;
                var arrOmset = array[i].subtotals;
                var arrOngkir = array[i].ongkir;

                this.calendarOptions.events.push({
                    title: "Total Chat : " + arrChat,
                    date: arrDate
                }, {
                    title: "Transaksi : " + arrTransaksi,
                    start: arrDate + 'T00:00:00',
                    end: arrDate + 'T23:59:59'
                }, {
                    title: "Bayar : " + arrTotal,
                    start: arrDate + 'T00:00:00',
                    end: arrDate + 'T23:59:59'
                }, {
                    title: "Omset : " + arrOmset,
                    start: arrDate + 'T00:00:00',
                    end: arrDate + 'T23:59:59'
                }, {
                    title: "Ongkir : " + arrOngkir,
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
        ...mapState("csReport", {
            csReports: state => state.csReports
        }),
    },
    methods: {
        handleDateClick: function (arg) {
            this.$router.push("/cs-report/" + arg.dateStr)
        },
        ...mapActions("csReport", ["getCsReports"])
    }
};
</script>
<template>
<FullCalendar :options="calendarOptions" />
</template>
