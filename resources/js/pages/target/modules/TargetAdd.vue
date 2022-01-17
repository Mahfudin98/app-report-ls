<template>
<div class="row">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{ name: 'target.data' }" class="btn btn-secondary">
                    <span class="material-icons align-middle">
                        reply
                    </span>
                    <span class="align-middle">Back</span>
                </router-link>
                <b-overlay :show="busy" rounded opacity="0.6" spinner-small spinner-variant="primary" class="d-inline-block float-right" @hidden="onHidden">
                    <button ref="button" :disabled="busy" @click="onClick" class="btn btn-primary">
                        <span class="material-icons align-middle">
                            save
                        </span>
                        <span class="align-middle">Save</span>
                    </button>
                </b-overlay>
                <!-- <button @click.prevent="submit" class="btn btn-primary">
                    <span class="material-icons align-middle">
                        save
                    </span>
                    <span class="align-middle">Save</span>
                </button> -->
            </div>
        </div>
        <div class="card-body">
            <form-target ref="targetForm"></form-target>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapState,
    mapMutations
} from "vuex";
import TargetForm from "./TargetForm.vue";
export default {
    name: "AddTarget",
    data() {
        return {
            busy: false,
            timeout: null
        }
    },
    methods: {
        submit() {
            this.$refs.targetForm.submit();
        },
        clearTimeout() {
            if (this.timeout) {
                clearTimeout(this.timeout)
                this.timeout = null
            }
        },
        setTimeout(callback) {
            this.clearTimeout()
            this.timeout = setTimeout(() => {
                this.clearTimeout()
                callback()
            }, 10000)
        },
        onHidden() {
            // Return focus to the button once hidden
            this.$refs.button.focus()
        },
        onClick() {
            this.busy = true;
            // Simulate an async request
            this.setTimeout(() => {
                this.busy = false
            });
            this.submit();
        }
    },
    components: {
        "form-target": TargetForm
    }
};
</script>
