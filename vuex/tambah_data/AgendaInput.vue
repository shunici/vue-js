<template>
  <div>   
   <div class="card">
        <div class="card-header">
           Ini adalah agenda input
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text"
                    class="form-control" name="" v-model="profil.nama" id="" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">{{profil.nama}}</small>
            </div>
             <div class="form-group">
                <label for="">Klub</label>
                <input type="text"
                    class="form-control" name="" id="" v-model="profil.klub"  aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">{{profil.klub}}</small>
            </div>
             <button type="button" class="btn btn-primary"  :disabled="isLoading"  @click='simpan'>{{ isLoading ? 'Loading...':'Tambahkan' }}</button>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
</div>
  </div>
</template>

<script>
    export default {
        name: 'AgendaInput',
        data (){
            return {
              profil : {
                    nama : '',
                    klub : '',
              }
            }
        },
        methods : {
            simpan(){
            //dispatch menyambung dengan action di store.js
              this.$store.dispatch('simpan_profil', this.profil)
              //line ini berfungsi ketika tombol diklik maka kosong data di inputan
              this.profil = {
                  nama : '',
                  klub : ''
              }
            }
        },
        computed: {
            isLoading() {
                return this.$store.state.isLoading
            }
        },
       
    }
</script>