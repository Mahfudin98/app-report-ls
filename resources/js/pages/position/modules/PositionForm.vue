<template>
    <div class="input-group mb-3">
        <!-- <span class="input-group-text" id="basic-addon2">Add New Position</span> -->
        <input
            class="form-control"
            type="text"
            name="name"
            id="name"
            placeholder="Position name"
            v-model="position.name"
        />
        <button @click.prevent="submit" class="btn btn-brand">
            <span class="icon">
                <i class="fas fa-save"></i>
            </span>
            <span class="text">Save Position</span>
        </button>
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
