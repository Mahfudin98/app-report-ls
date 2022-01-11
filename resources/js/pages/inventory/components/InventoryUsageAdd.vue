<template>
<div class="card bg-primary">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <router-link :to="{ name: 'inventory.usage' }" class="btn btn-secondary">
                <span class="material-icons align-middle">
                    reply
                </span>
                <span class="align-middle">Back</span>
            </router-link>
            <button @click.prevent="submit" class="btn btn-primary">
                <span class="material-icons align-middle">
                    save
                </span>
                <span class="align-middle">Save Data</span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <inventory-usage-form ref="InventoryUsageForm"></inventory-usage-form>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState,
    mapMutations
} from "vuex";
import InventoryUsageForm from "./InventoryUsageForm.vue";
export default {
    name: "AddReportCS",
    methods: {
        submit() {
            this.$refs.InventoryUsageForm.submit();
        }
    },
    components: {
        "inventory-usage-form": InventoryUsageForm,
    }
};
</script>
