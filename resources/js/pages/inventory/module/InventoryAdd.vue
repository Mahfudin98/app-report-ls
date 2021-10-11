<template>
    <div>
        <inventory-form></inventory-form>
        <button type="submit" class="btn btn-primary mr-2" @click.prevent="submit"><i class="fa fa-save"></i> Save</button>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import FormInventory from './InventoryForm.vue'
    export default {
        name: 'AddInventory',
        methods: {
            ...mapActions('inventory', ['submitInventory']),
            submit() {
                this.submitInventory().then(() => {
                    this.$swal({
                        background: '#3085d6',
                        title: 'Ditambah!',
                        text: 'Data Berhasil ditambah!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                })
            }
        },
        components: {
            'inventory-form': FormInventory
        },
    }
</script>
