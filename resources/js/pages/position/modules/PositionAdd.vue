<template>
    <div>
        <position-form></position-form>
        <button type="submit" class="btn btn-primary mr-2" @click.prevent="submit"><i class="fa fa-save"></i> Save</button>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import Formpositions from './Form.vue'
    export default {
        name: 'AddPosition',
        methods: {
            ...mapActions('position', ['submitPosition']),
            submit() {
                this.submitPosition().then(() => {
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
            'position-form': Formpositions
        },
    }
</script>
