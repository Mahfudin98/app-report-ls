<template>
    <div class="col-lg-4">
        <h3 class="media-sidebar__title">Add Position</h3>
        <div class="media-sidebar">
            <div class="main-content new-page-content">
                <label>
                    <span class="new-page-label">Nama Posisi</span>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Position name"
                        v-model="position.name"
                    />
                </label>
                <button
                    class="primary-default-btn"
                    type="submit"
                    @click.prevent="submit"
                >
                    <lord-icon
                        src="https://cdn.lordicon.com/mecwbjnp.json"
                        trigger="loop-on-hover"
                        colors="primary:#ffffff,secondary:#fad1e6"
                        style="width:30px;height:30px"
                    >
                    </lord-icon>
                    Add new
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    name: "FormPositions",
    computed: {
        ...mapState(["errors"]),
        ...mapState("position", {
            position: state => state.position
        })
    },
    methods: {
        ...mapMutations("position", ["CLEAR_FORM"]),
        ...mapActions("position", ["submitPosition"]),
        submit() {
            this.submitPosition().then(() => {
                this.$swal({
                    background: "#FFFFFF",
                    title: "Ditambah!",
                    text: "Data Berhasil ditambah!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
        }
    },
    destroyed() {
        this.CLEAR_FORM();
    }
};
</script>
