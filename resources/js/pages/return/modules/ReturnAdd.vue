<template>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="d-flex justify-content-between align-items-center mb-20">
            <div class="row xs-gap">
                <div class="col-12">
                    <router-link :to="{ name: 'return.data' }" class="btn btn-secondary">
                        <span class="material-icons align-middle">
                            reply
                        </span>
                        <span class="align-middle">Back</span>
                    </router-link>
                </div>
            </div>
            <button @click.prevent="submit" class="btn btn-primary">
                <span class="material-icons align-middle">
                    save
                </span>
                <span class="align-middle">Save</span>
            </button>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <ReturnForm ref="ReturnForm" />
    </div>
</div>
</template>

<script>
import ReturnForm from './ReturnForm.vue'
export default {
    components: {
        ReturnForm
    },
    methods: {
        submit() {
            this.$refs.ReturnForm.submit();
        }
    }
}
</script>
