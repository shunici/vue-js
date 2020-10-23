<template>
  <div>   
   <div class="card">
        <div class="card-header">
           Ini adalah agenda show
        </div>
        <div class="card-body">
           <ul><li v-for="item in profil" :key="item.id">dia adalah {{item.nama}} yang berasal dari klub {{item.klub}}</li></ul>
        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
</div>
  </div>
</template>

<script>
    export default {
        name: 'AgendaShow',
        computed : {
            profil(){
                return this.$store.state.profil
            }
        }
    }
</script>