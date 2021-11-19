<template>
    <main>
        <div class="form-group">
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
        <div class="form-group">
            <label for="target">Target</label>
            <input
                class="form-control"
                type="number"
                name="target"
                id="target"
                placeholder="Product target"
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
                        placeholder="Product start_date"
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
                        placeholder="Product end_date"
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
        ...mapActions("target", ["submitTarget"]),
        submit() {
            let form = new FormData();

            form.append("user_id", this.userId);
            form.append("adv_name", this.userName);
            form.append("target", this.target.target);
            form.append("start_date", this.target.start_date);
            form.append("end_date", this.target.end_date);
            this.submitTarget(form).then(() => {
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
};
</script>
