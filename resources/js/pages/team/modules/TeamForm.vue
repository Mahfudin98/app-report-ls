<template>
    <div class="rui-snippet-preview demo">
        <form action="">
            <div class="row vertical-gap sm-gap justify-content-center">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="form-group" :class="{ 'has-error': errors.name }">
                                <label for="name">Name</label>
                                <input
                                    class="form-control"
                                    id="name"
                                    required
                                    type="text"
                                    placeholder="Enter name"
                                    v-model="team.name"
                                />
                                <p class="text-danger" v-if="errors.name">
                                    {{ errors.name[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.address }">
                                <label for="address">Alamat Team</label>
                                <input
                                    class="form-control"
                                    id="address"
                                    required
                                    type="text"
                                    placeholder="Enter Address"
                                    v-model="team.address"
                                />
                                <p class="text-danger" v-if="errors.address">
                                    {{ errors.address[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.phone }">
                                <label for="phone">Phone Team</label>
                                <input
                                    class="form-control"
                                    id="phone"
                                    required
                                    type="tel"
                                    placeholder="Enter phone"
                                    v-model="team.phone"
                                />
                                <p class="text-danger" v-if="errors.phone">
                                    {{ errors.phone[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.tempat_lahir }">
                                <label for="tempat_lahir">Tempat Lahir Team</label>
                                <input
                                    class="form-control"
                                    id="tempat_lahir"
                                    required
                                    type="text"
                                    placeholder="Enter Tempat Lahir"
                                    v-model="team.tempat_lahir"
                                />
                                <p class="text-danger" v-if="errors.tempat_lahir">
                                    {{ errors.tempat_lahir[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.tanggal_lahir }">
                                <label for="tanggal_lahir">Tanggal Lahir Team</label>
                                <input
                                    class="form-control"
                                    id="tanggal_lahir"
                                    required
                                    type="date"
                                    placeholder="Enter Tanggal Lahir"
                                    v-model="team.tanggal_lahir"
                                />
                                <p class="text-danger" v-if="errors.tanggal_lahir">
                                    {{ errors.tanggal_lahir[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.gender }">
                                <label for="gender">Gender</label>
                                <select
                                    id="gender"
                                    class="form-control"
                                    required
                                    v-model="team.gender"
                                >
                                    <option selected disabled value=""
                                        >Select Gender</option
                                    >
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <p class="text-danger" v-if="errors.gender">
                                    {{ errors.gender[0] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body mnt-6 mnb-6">
                            <div class="form-group" :class="{ 'has-error': errors.email }">
                                <label for="email">Email Team</label>
                                <input
                                    class="form-control"
                                    id="email"
                                    required
                                    type="email"
                                    placeholder="Enter email"
                                    v-model="team.email"
                                />
                                <p class="text-danger" v-if="errors.email">
                                    {{ errors.email[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.username }">
                                <label for="username">Username</label>
                                <input
                                    class="form-control"
                                    id="username"
                                    type="text"
                                    required
                                    placeholder="Enter username"
                                    v-model="team.username"
                                />
                                <p class="text-danger" v-if="errors.username">
                                    {{ errors.username[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.password }">
                                <label for="password">Password</label>
                                <input
                                    class="form-control"
                                    id="password"
                                    type="password"
                                    placeholder="Enter password"
                                    v-model="team.password"
                                />
                                <p v-if="this.$route.name == `teams.edit`">*Kosongkan jika tidak ingin mengganti</p>
                                <p class="text-danger" v-if="errors.password">
                                    {{ errors.password[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.position_id }">
                                <label for="position_id">Position</label>
                                <select
                                    id="position_id"
                                    class="form-control"
                                    required
                                    v-model="team.position_id"
                                >
                                    <option selected disabled value=""
                                        >Select Position</option
                                    >
                                    <option
                                        v-for="row in positions.data"
                                        :key="row.name"
                                        :value="row.id"
                                    >
                                        {{ row.name }}
                                    </option>
                                </select>
                                <p
                                    class="text-danger"
                                    v-if="errors.position_id"
                                >
                                    {{ errors.position_id[0] }}
                                </p>
                            </div>
                            <div class="form-group" v-if="team.position_id == 12 || team.position_id == 14 || team.position_id == 15" :class="{ 'has-error': errors.parent_id }">
                                <label for="parent_id">Nama ADV</label>
                                <select
                                    id="parent_id"
                                    class="form-control"
                                    v-model="team.parent_id"
                                >
                                    <option selected value=""
                                        >Select ADV</option
                                    >
                                    <option
                                        v-for="items in users"
                                        :key="items.created_at"
                                        :value="items.id"
                                        >{{ items.name }}</option
                                    >
                                </select>
                                <p class="text-danger" v-if="errors.parent_id">
                                    {{ errors.parent_id[0] }}
                                </p>
                            </div>
                            <div class="form-group" :class="{ 'has-error': errors.image }">
                                <label for="file-input">Image</label>
                                <input
                                    type="file"
                                    class="form-control"
                                    accept="image/*"
                                    @change="uploadImage($event)"
                                    id="file-input"
                                />
                                <p v-if="this.$route.name == `teams.edit`">*Kosongkan jika tidak ingin mengganti</p>
                                <p class="text-danger" v-if="errors.image">
                                    {{ errors.image[0] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
                    position_id: res.data.position_id,
                    parent_id: res.data.parent_id,
                    address: res.data.address,
                    phone: res.data.phone,
                    tempat_lahir: res.data.tempat_lahir,
                    tanggal_lahir: res.data.tanggal_lahir,
                    email: res.data.email,
                    username: res.data.username,
                    password: "",
                    gender: res.data.gender
                };
            });
        }
    },
    data() {
        return {
            team: {
                name: "",
                image: "",
                position_id: "",
                parent_id: "",
                address: "",
                phone: "",
                tempat_lahir: "",
                tanggal_lahir: "",
                email: "",
                username: "",
                password: '',
                gender: ""
            }
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
            if (this.team.parent_id == null) {
                form.append("parent_id", "");
            } else {
                form.append("parent_id", this.team.parent_id);
            }
            form.append("address", this.team.address);
            form.append("phone", this.team.phone);
            form.append("email", this.team.email);
            form.append("tempat_lahir", this.team.tempat_lahir);
            form.append("tanggal_lahir", this.team.tanggal_lahir);
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
                        tempat_lahir: "",
                        tanggal_lahir: "",
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
                        tempat_lahir: "",
                        tanggal_lahir: "",
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
