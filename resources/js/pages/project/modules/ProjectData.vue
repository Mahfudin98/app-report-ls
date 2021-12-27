<template>
<main>
    <div class="rui-page-content">
        <div class="container-fluid">
            <h2>Bar Chart</h2>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Bulan</label>
                        <select v-model="month" class="form-control">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Tahun</label>
                        <select v-model="year" class="form-control">
                            <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <label v-if="$can('create projects')">
                        Setting <b-icon icon="gear-fill"></b-icon>
                    </label>
                    <label v-else>Export To Excel</label>
                    <br>
                    <div class="btn-group-lg" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-primary">
                            <b-icon icon="printer-fill"></b-icon>
                        </button>
                        <router-link :to="{ name: 'project.add' }" class="btn btn-brand" v-if="$can('create projects')">
                            <b-icon icon="plus-circle-fill"></b-icon>
                        </router-link>
                    </div>
                </div>
            </div>
            <div class="row vertical-gap">
                <div class="col-lg-12">
                    <div class="rui-widget p-0">
                        <!-- for chart -->
                    </div>
                </div>
            </div>
            <div class="rui-gap-2"></div>
            <h2>Calendar</h2>
            <Calender />
        </div>
    </div>
</main>
</template>

<script>
import {
    mapActions,
    mapState
} from "vuex";
import VueMomentsAgo from "vue-moments-ago";
import Calender from "./Calendar.vue";
import moment from "moment";
export default {
    components: {
        VueMomentsAgo,
        Calender
    },
    created() {
        this.getProducts();
    },

    data() {
        return {
            month: moment().format("MM"),
            year: moment().format("Y")
        };
    },

    computed: {
        ...mapState("product", {
            products: state => state.products
        }),
        years() {
            return _.range(
                2019,
                moment()
                .add(1, "years")
                .format("Y")
            );
        },
    },

    watch: {
        search() {
            this.getProducts(this.search);
        }
    },

    methods: {
        ...mapActions("product", ["getProducts", "removeProduct"]),
        deleteProduct(id) {
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
                    this.removeProduct(id);
                }
            });
        }
    }
};
</script>
