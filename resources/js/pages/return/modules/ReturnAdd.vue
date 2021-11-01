<template>
<div class="rui-page-content">
        <div class="container-fluid">
            <div
                class="d-flex justify-content-between align-items-center mb-20"
            >
                <router-link
                    :to="{ name: 'return.data' }"
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
                    <span class="text">Save</span>
                </button>
            </div>
            <ReturnForm ref="ReturnForm"/>
        </div>
    </div>
</template>
<script>
import ReturnForm from './ReturnForm.vue'
export default {
    components : {ReturnForm},
    methods: {
        submit() {
            this.$refs.ReturnForm.submit();
        }
    }
}
</script>
