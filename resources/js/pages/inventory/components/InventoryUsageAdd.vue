<template>
    <div class="rui-page-content">
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <router-link
                    :to="{ name: 'inventory.usage' }"
                    class="btn btn-secondary"
                >
                    <span class="icon">
                        <span class="fas fa-arrow-alt-circle-left"></span>
                    </span>
                    <span class="text">Back</span>
                </router-link>
                <button
                    @click.prevent="submit"
                    class="btn btn-brand"
                >
                    <span class="icon">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Save Data</span>
                </button>
            </div>
            <inventory-usage-form ref="InventoryUsageForm"></inventory-usage-form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapState, mapMutations } from "vuex";
import InventoryUsageForm from "./InventoryUsageForm.vue";
export default {
    name: "AddReportCS",
    methods: {
        submit() {
            this.$refs.InventoryUsageForm.submit();
        }
    },
    components: {
        "inventory-usage-form" : InventoryUsageForm,
    }
};
</script>
