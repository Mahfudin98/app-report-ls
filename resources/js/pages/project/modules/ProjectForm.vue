<template>
<div class="row vertical-gap sm-gap justify-content-center">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body mnt-6 mnb-6">
                <div class="mb-3" :class="{ 'has-error': errors.url }">
                    <label for="url">URL Name</label>
                    <input class="form-control" id="url" required type="text" v-model="web.url" readonly />
                    <p class="text-danger" v-if="errors.url">
                        {{ errors.url[0] }}
                    </p>
                </div>
                <div class="mb-3" :class="{ 'has-error': errors.date }">
                    <label for="date">Date</label>
                    <input class="form-control" id="date" required type="date" placeholder="Enter Date" v-model="web.date" />
                    <p class="text-danger" v-if="errors.date">
                        {{ errors.date[0] }}
                    </p>
                </div>
                <div class="mb-3" :class="{ 'has-error': errors.image }">
                    <label for="file-input">Image</label>
                    <input type="file" class="form-control" accept="image/*" @change="uploadImage($event)" id="file-input" />
                    <p class="text-danger" v-if="errors.image">
                        {{ errors.image[0] }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body mnt-6 mnb-6">
                <section v-for="(row, index) in pages" :key="index">
                    <div class="mb-3">
                        <label for="page">Page Name</label>
                        <input class="form-control" id="page" required type="text" placeholder="Nama Page" v-model="row.page" disabled />
                    </div>
                    <div class="mb-3">
                        <label for="count">Total View</label>
                        <input class="form-control" id="count" required type="number" placeholder="Jumlah Total View" v-model="row.count" />
                    </div>
                </section>
                <!--
                <section v-for="(row, index) in pages" :key="index">
                    <div class="mb-3">
                        <label for="page" class="text-white">Page Name</label>
                        <input class="form-control" id="page" required type="text" placeholder="Nama Page" v-model="row.page" />
                    </div>
                    <div class="mb-3">
                        <label for="count" class="text-white">Total View</label>
                        <input class="form-control" id="count" required type="number" placeholder="Jumlah Total View" v-model="row.count" />
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-brand" type="button" @click="removePages(index)">
                            <span class="icon">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Remove Pages</span>
                        </button>
                    </div>
                </section>
                <button class="btn btn-primary" type="button" @click="addPages">
                    <span class="icon">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Pages</span>
                </button>
                -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapState,
    mapActions,
    mapMutations
} from "vuex";
export default {
    name: "ProjectForm",
    created() {

    },
    data() {
        return {
            web: {
                url: 'lsskincarepusat.id',
                date: '',
                image: ''
            },
            pages: [{
                page: 'Home',
                count: ''
            }, {
                page: 'Aesthetcic Clinic',
                count: ''
            }]
        };
    },
    computed: {
        ...mapState(["errors"]),
    },
    methods: {
        addPages: function () {
            this.pages.push({
                page: '',
                count: ''
            });
        },
        removePages(index) {
            this.pages.splice(index, 1);
        },

        uploadImage(event) {
            this.web.image = event.target.files[0];
        },

        ...mapActions("reportWeb", ["submitReportWebs"]),

        submit() {
            let form = new FormData();

            form.append("url", this.web.url);
            form.append("date", this.web.date);
            form.append("image", this.web.image);

            for (var i = 0; i < this.pages.length; i++) {
                var array = this.pages[i]
                var page = array.page;
                var count = array.count;
                form.append("page[" + i + "]", page);
                form.append("count[" + i + "]", count);
            }

            if (this.$route.name == "project.add") {
                this.submitReportWebs(form).then(() => {
                    this.$swal({
                        background: "#FFFFFF",
                        title: "Ditambah!",
                        text: "Data Berhasil ditambah!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    });

                    this.$router.push({
                        name: 'project.view',
                        params: {
                            date: this.web.date
                        }
                    });

                    this.web = {
                        url: 'lsskincarepusat.id',
                        date: '',
                        image: ''
                    };

                    this.pages = [];
                });
            }
        }
    }
};
</script>
