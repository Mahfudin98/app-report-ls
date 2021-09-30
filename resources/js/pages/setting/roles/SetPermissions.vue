<template>
    <div class="row new-page__row">
        <div class="col-xl-6 col-md-6">
            <div class="main-content new-page-content">
                <div class="white-block">
                    <p class="white-block__title">Roles</p>
                    <div class="select-wrapper">
                        <select
                            class="select transparent-btn"
                            v-model="role_user.role"
                        >
                            <option value="">Pilih</option>
                            <option
                                v-for="(row, index) in roles"
                                :value="row.name"
                                :key="index"
                                >{{ row.name }}</option
                            >
                        </select>
                    </div>

                    <p class="text-danger" v-if="role_user.role">
                        {{ role_user.role[0] }}
                    </p>
                </div>
                <div class="white-block">
                    <p class="white-block__title">User</p>
                    <div class="select-wrapper">
                        <select
                            class="select transparent-btn"
                            v-model="role_user.user_id"
                        >
                            <option value="">Pilih</option>
                            <option
                                v-for="(row, index) in users"
                                :value="row.id"
                                :key="index"
                                >{{ row.name }} ({{ row.email }})</option
                            >
                        </select>
                    </div>

                    <p class="text-danger" v-if="role_user.role">
                        {{ role_user.role[0] }}
                    </p>
                </div>
                <div class="new-page-content white-block">
                    <button class="primary-default-btn" @click="setRole">
                        <lord-icon
                            src="https://cdn.lordicon.com/xhwleznj.json"
                            trigger="loop"
                            colors="primary:#fffff,secondary:#ffffff"
                            style="width:50px;height:50px"
                        >
                        </lord-icon>
                        Set Roles
                    </button>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="white-block">
                <div class="row new-page__row">
                    <div class="col-xl-9 col-md-6">
                        <div class="select-wrapper">
                            <select
                                class="select transparent-btn"
                                v-model="role_selected"
                            >
                                <option value="">Pilih Roles</option>
                                <option
                                    v-for="(row, index) in roles"
                                    :value="row.id"
                                    :key="index"
                                    >{{ row.name }}</option
                                >
                            </select>
                        </div>

                        <p class="text-danger" v-if="role_selected">
                            {{ role_selected[0] }}
                        </p>
                    </div>
                    <div class="col-xl-2 col-md-6">
                        <div class="select-wrapper">
                            <button
                                class="primary-default-btn"
                                @click="checkPermission"
                            >
                                {{ loading ? "Loading..." : "Check" }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="white-block checkboxes">
                <p class="white-block__title">Permissions</p>
                <label v-for="(row, index) in permissions" :key="index">
                    <input
                        type="checkbox"
                        :key="index"
                        :value="row.name"
                        :checked="
                            role_permission.findIndex(
                                x => x.name == row.name
                            ) != -1
                        "
                        @click="addPermission(row.name)"
                    />
                    <span>{{ row.name }}</span> <br :key="'row' + index" />
                    <br :key="'enter' + index" v-if="(index + 1) % 4 == 0" />
                </label>

                <button class="primary-default-btn" @click="setPermission">
                    Send
                </button>
            </div>
        </div>
    </div>
</template>
<script>
import { mapActions, mapState, mapMutations } from "vuex";
import Label from "../../../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Label.vue";

export default {
    components: { Label },
    name: "SetPermission",
    data() {
        return {
            role_user: {
                role: "",
                user_id: ""
            },
            role_selected: "",
            new_permission: [],
            loading: false,
            alert_permission: false,
            alert_role: false
        };
    },
    created() {
        //KETIKA COMPONENT DI-LOAD, MAKA KITA AKAN ME-REQUEST 3 DATA BERIKUT
        this.getRoles(); //DATA ROLES
        this.getAllPermission(); //DATA PERMISSIONS
        this.getUserLists(); //DATA USERS
    },
    computed: {
        ...mapState(["errors"]), //ME-LOAD STATE ERRORS
        ...mapState("user", {
            users: state => state.users, //ME-LOAD STATE USERS
            roles: state => state.roles, //ME-LOAD STATE ROLES
            permissions: state => state.permissions, //ME-LOAD STATE PERMISSION

            //STATE YANG MENAMPUNG PERMISSION YG TELAH DI-ASSIGN
            role_permission: state => state.role_permission
        })
    },
    methods: {
        //LOAD SEMUA FUNGSI YANG ADA DI MODULE STORE USER
        ...mapActions("user", [
            "getUserLists",
            "getRoles",
            "getAllPermission",
            "getRolePermission",
            "setRolePermission",
            "setRoleUser"
        ]),
        //LOAD MUTATIONS DARI STORE USER
        ...mapMutations("user", ["CLEAR_ROLE_PERMISSION"]),
        //FUNGSI INI AKAN BERJALAN KETIKA TOMBOL SET ROLE DIKLIK
        setRole() {
            //KIRIM PERMINTAAN KE BACKEND
            this.setRoleUser(this.role_user).then(() => {
                this.alert_role = true; //AKTIFKAN ALERT JIKA BERHASIL
                setTimeout(() => {
                    //BEBERAPA DETIK KEMUDIAN, SET DEFAULT ROLE USER
                    this.role_user = {
                        role: "",
                        user_id: ""
                    };
                    //MATIKAN ALERT
                    this.alert_role = false;
                }, 1000);
            });
        },
        //KETIKA LIST PERMISSION DI CENTANG, MAKA FUNGSI INI BERJALAN
        addPermission(name) {
            //DICEK KE NEW_PERMISSION BERDASARKAN NAME
            let index = this.new_permission.findIndex(x => x == name);
            //APABIL TIDAK TERSEDIA, INDEXNYA -1
            if (index == -1) {
                //MAKA TAMBAHKAN KE LIST
                this.new_permission.push(name);
            } else {
                //JIKA SUDAH ADA, MAKA HAPUS DARI LIST
                this.new_permission.splice(index, 1);
            }
        },
        //KETIKA TOMBOL CHECK DITEKAN, MAKA FUNGSI INI BERJALAN
        //FUNGSI INI UNTUK MENGAMBIL LIST PERMISSION YANG TELAH DI ASSIGN
        //KE DALAM ROLE YANG DIPILIH
        checkPermission() {
            this.loading = true; //AKTIFKAN LOADING TOMBOL
            //KIRIM PERMINTAAN KE BACKEND
            this.getRolePermission(this.role_selected).then(() => {
                //APABILA BERHASIL, MATIKAN LOADING
                this.loading = false;
                //PERMISSION YANG TELAH DIASSIGN AKAN DI MERGE KE NEW_PERMISSION
                this.new_permission = this.role_permission;
            });
        },
        //FUNGSI INI BERJALAN KETIKA TOMBOL SET PERMISSION DITEKAN
        setPermission() {
            //KIRIM PERMINTAAN KE SERVER
            this.setRolePermission({
                role_id: this.role_selected,
                permissions: this.new_permission
            }).then(res => {
                //APABIL BERHASIL
                if (res.status == "success") {
                    //NYALAKAN ALERT
                    this.alert_permission = true;
                    setTimeout(() => {
                        //BEBERAPA DETIK KEMUDIAN, KEMBALIKAN KE DEFAULT
                        this.role_selected = "";
                        this.new_permission = [];
                        this.loading = false;
                        this.alert_permission = false;
                        this.CLEAR_ROLE_PERMISSION();
                    }, 1000);
                }
            });
        }
    }
};
</script>

<style type="text/css">
.tab-pane {
    height: 150px;
    overflow-y: scroll;
}
</style>
