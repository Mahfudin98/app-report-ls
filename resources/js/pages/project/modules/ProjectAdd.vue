<template>
<div class="row">
    <page-loader />
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-20">
                <router-link :to="{ name: 'project.data' }" class="btn btn-secondary">
                    <span class="material-icons align-middle">
                        reply
                    </span>
                    <span class="align-middle">Back</span>
                </router-link>
                <b-overlay :show="busy" rounded opacity="0.6" spinner-small spinner-variant="primary" class="d-inline-block float-right mb-2" @hidden="onHidden">
                    <button ref="button" :disabled="busy" @click="onClick" class="btn btn-primary">
                        <span class="material-icons align-middle">
                            save
                        </span>
                        <span class="align-middle">Save</span>
                    </button>
                    <!-- <b-button ref="button" :disabled="busy" variant="brand" @click="onClick">
                    Save <b-icon  icon="upload" aria-hidden="true"></b-icon>
                </b-button> -->
                </b-overlay>
            </div>
        </div>
        <div class="card-body">
            <form-project ref="projectForm"></form-project>
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
import ProjectForm from "./ProjectForm.vue";
import PageLoader from '../../../components/PageLoader.vue'
export default {
    name: "AddTeam",
    data() {
        return {
            busy: false,
            timeout: null
        }
    },
    beforeDestroy() {
        this.clearTimeout()
    },
    methods: {
        submit() {
            this.$refs.projectForm.submit();
        },
        // button
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
        "form-project": ProjectForm,
        PageLoader
    }
};
</script>
