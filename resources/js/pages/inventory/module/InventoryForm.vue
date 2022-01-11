<template>
<div class="input-group mb-3">
    <!-- <span class="input-group-text" id="basic-addon2">Add New Inventory</span> -->
    <input class="form-control" type="text" name="name" id="name" placeholder="Nama Barang" v-model="inventory.name" />
    <button @click.prevent="submit" class="btn btn-primary">
        <span class="material-icons align-middle">
            save
        </span>
        <span class="align-middle">Save Inventory</span>
    </button>
</div>
</template>

<script>
import {
    mapState,
    mapMutations,
    mapActions
} from "vuex";
export default {
    name: "FormInventory",
    computed: {
        ...mapState(["errors"]),
        ...mapState("inventory", {
            inventory: state => state.inventory
        })
    },
    methods: {
        ...mapMutations("inventory", ["CLEAR_FORM"]),
        ...mapActions("inventory", ["submitInventory"]),
        submit() {
            this.submitInventory().then(() => {
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
