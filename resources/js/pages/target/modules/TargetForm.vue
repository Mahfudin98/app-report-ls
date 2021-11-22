<template>
    <main>
        <div class="form-group" v-if="this.$route.name == 'target.add'">
            <label for="adv_name">Nama Adv</label>
            <select
                class="form-control"
                id="adv_name"
                required
                v-model="target.user_id"
            >
                <option selected value="">Select ADV</option>
                <option
                    v-for="items in users"
                    :key="items.created_at"
                    :value="items"
                    >{{ items.name }}</option
                >
            </select>
        </div>
        <div class="form-group" v-if="this.$route.name == 'target.edit'">
            <label for="target">Nama Adv</label>
            <input
                class="form-control"
                type="text"
                name="target"
                id="target"
                placeholder="Omset target"
                v-model="target.user_id"
                disabled
                required
            />
        </div>
        <div class="form-group">
            <label for="target">Target</label>
            <input
                class="form-control"
                type="number"
                name="target"
                id="target"
                placeholder="Omset target"
                v-model="target.target"
                required
            />
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input
                        class="form-control"
                        type="date"
                        name="start_date"
                        id="start_date"
                        placeholder="Product Start Date"
                        v-model="target.start_date"
                        required
                    />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input
                        class="form-control"
                        type="date"
                        name="end_date"
                        id="end_date"
                        placeholder="Product End Date"
                        v-model="target.end_date"
                        required
                    />
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
export default {
    created() {
        this.getAdv();
        if (this.$route.name == "target.edit") {
            this.editTarget(this.$route.params.id).then(res => {
                this.target = {
                    user_id: res.data.adv_name,
                    target: res.data.target,
                    start_date: res.data.start_date,
                    end_date: res.data.end_date
                };
            });
        }
    },
    data() {
        return {
            target: {
                user_id: "",
                target: "",
                start_date: "",
                end_date: ""
            }
        };
    },

    name: "FormProduct",
    computed: {
        ...mapState("user", {
            users: state => state.users
        }),
        userId() {
            var result = this.target.user_id.id;
            return result;
        },
        userName() {
            var result = this.target.user_id.name;
            return result;
        }
    },
    methods: {
        ...mapActions("user", ["getAdv"]),
        ...mapActions("target", ["submitTarget", "editTarget", "updateTarget"]),
        ...mapMutations("target", ["SET_ID_UPDATE"]),
        submit() {
            let form = new FormData();
            if (this.$route.name == "target.add") {
                form.append("user_id", this.userId);
                form.append("adv_name", this.userName);
            }
            form.append("target", this.target.target);
            form.append("start_date", this.target.start_date);
            form.append("end_date", this.target.end_date);

            if (this.$route.name == "target.add") {
                this.submitTarget(form).then(() => {
                    this.target = {
                        user_id: "",
                        target: "",
                        start_date: "",
                        end_date: ""
                    };

                    this.$router.push({ name: "target.data" });
                });
            } else if (this.$route.name == "target.edit") {
                this.SET_ID_UPDATE(this.$route.params.id);
                this.updateTarget(form).then(() => {
                    this.target = {
                        user_id: "",
                        target: "",
                        start_date: "",
                        end_date: ""
                    };

                    this.$router.push({ name: "target.data" });
                });
            }
        }
    }
};
</script>
