<template>
    <div class="row new-page__row">
        <div class="col-xl-5 col-md-6">
            <div class="main-content new-page-content">
                <label>
                    <span class="new-page-label">Nama Team</span>
                    <input
                        required=""
                        type="text"
                        placeholder="Enter page title"
                        v-model="team.name"
                    />
                    <p class="text-danger" v-if="errors.name">
                        {{ errors.name[0] }}
                    </p>
                </label>
                <label>
                    <span class="new-page-label">Alamat Team</span>
                    <input
                        required=""
                        type="text"
                        placeholder="Enter page title"
                        v-model="team.address"
                    />
                    <p class="text-danger" v-if="errors.address">
                        {{ errors.address[0] }}
                    </p>
                </label>
                <label>
                    <span class="new-page-label">Nomor HP Team</span>
                    <input
                        required=""
                        type="tel"
                        placeholder="Enter page title"
                        v-model="team.phone"
                    />
                    <p class="text-danger" v-if="errors.phone">
                        {{ errors.phone[0] }}
                    </p>
                </label>
                <label>
                    <span class="new-page-label">Email Team</span>
                    <input
                        required=""
                        type="email"
                        placeholder="Enter page title"
                        v-model="team.email"
                    />
                    <p class="text-danger" v-if="errors.email">
                        {{ errors.email[0] }}
                    </p>
                </label>
                <div class="white-block">
                    <p class="white-block__title">Gender</p>
                    <div class="select-wrapper">
                        <select
                            class="select transparent-btn"
                            required=""
                            v-model="team.gender"
                        >
                            <option selected="" disabled="" value=""
                                >Select parent page</option
                            >
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <p class="text-danger" v-if="errors.gender">
                        {{ errors.gender[0] }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="new-page-content white-block">
                <span class="new-page-label">Username</span>
                <input
                    required=""
                    type="text"
                    placeholder="Enter page title"
                    v-model="team.username"
                />
                <p class="text-danger" v-if="errors.username">
                    {{ errors.username[0] }}
                </p>
                <span class="new-page-label">Password</span>
                <input
                    required=""
                    type="password"
                    placeholder="Enter page title"
                    v-model="team.password"
                />
                <p class="text-danger" v-if="errors.password">
                    {{ errors.password[0] }}
                </p>
            </div>
            <div class="white-block">
                <p class="white-block__title">Position</p>
                <div class="select-wrapper">
                    <select
                        class="select transparent-btn"
                        required=""
                        v-model="team.position_id"
                    >
                        <option selected="" disabled="" value=""
                            >Select parent page</option
                        >
                        <option
                            v-for="row in positions.data"
                            :key="row.name"
                            :value="row.id"
                        >
                            {{ row.name }}
                        </option>
                    </select>
                </div>
                <p class="text-danger" v-if="errors.position_id">
                    {{ errors.position_id[0] }}
                </p>
            </div>

            <div class="white-block">
                <p class="white-block__title">Nama ADV</p>
                <div class="select-wrapper">
                    <select
                        class="select transparent-btn"
                        v-model="team.parent_id"
                    >
                        <option selected="" disabled="" value=""
                            >Select parent page</option
                        >
                        <option v-for="items in users" :key="items.created_at" :value="items.id">{{items.name}}</option>
                    </select>
                </div>
            </div>
            <p class="text-danger" v-if="errors.parent_id">
                {{ errors.parent_id[0] }}
            </p>
        </div>
        <div class="col-xl-8 col-md-6">
            <div class="new-page-content white-block">
                <span class="white-block__title">Images</span>
                <input
                    type="file"
                    class="form-control"
                    accept="image/*"
                    @change="uploadImage($event)"
                    id="file-input"
                />
                <!-- <div id="preview">
                    <img v-if="url" :src="url" />
                </div> -->
                <p class="text-danger" v-if="errors.image">
                    {{ errors.image[0] }}
                </p>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState, mapActions, mapMutations } from "vuex";
export default {
    name: "TeamForm",
    created() {
        this.getPositions();
        this.getAdv();

        if (this.$route.name == "teams.edit") {
            this.editTeam(this.$route.params.id).then(res => {
                this.team = {
                    name: res.data.name,
                    image: "",
                    position_id: res.position_id,
                    parent_id: res.parent_id,
                    address: res.address,
                    phone: res.phone,
                    email: res.email,
                    username: res.username,
                    password: "",
                    gender: res.gender
                };
            });
        }
    },
    data() {
        return {
            // url: null,
            team: {
                name: "",
                image: "",
                position_id: "",
                parent_id: "",
                address: "",
                phone: "",
                email: "",
                username: "",
                password: "",
                gender: ""
            },
        };
    },
    computed: {
        ...mapState(["errors"]),
        ...mapState("position", {
            positions: state => state.positions
        }),
        ...mapState("user", {
            users: state => state.users
        })
    },
    methods: {
        ...mapActions("team", ["submitTeam", "editTeam", "updateTeam"]),
        ...mapActions("position", ["getPositions"]),
        ...mapMutations("team", ["SET_ID_UPDATE"]),
        ...mapActions("user", ["getAdv"]),

        uploadImage(event) {
            this.team.image = event.target.files[0];
        },

        submit() {
            let form = new FormData();

            form.append("name", this.team.name);
            form.append("position_id", this.team.position_id);
            form.append("parent_id", this.team.parent_id);
            form.append("address", this.team.address);
            form.append("phone", this.team.phone);
            form.append("email", this.team.email);
            form.append("username", this.team.username);
            form.append("password", this.team.password);
            form.append("gender", this.team.gender);
            form.append("image", this.team.image);

            if (this.$route.name == "teams.add") {
                this.submitTeam(form).then(() => {
                    this.team = {
                        name: "",
                        image: "",
                        position_id: "",
                        parent_id: "",
                        address: "",
                        phone: "",
                        email: "",
                        username: "",
                        password: "",
                        gender: ""
                    };

                    this.$router.push({ name: "teams.data" });
                });
            } else if (this.$route.name == "teams.edit") {
                this.SET_ID_UPDATE(this.$route.params.id);
                this.updateTeam(form).then(() => {
                    this.team = {
                        name: "",
                        image: "",
                        position_id: "",
                        parent_id: "",
                        address: "",
                        phone: "",
                        email: "",
                        username: "",
                        password: "",
                        gender: ""
                    };
                    this.$router.push({ name: "teams.data" });
                });
            }
        }
    }
};
</script>
