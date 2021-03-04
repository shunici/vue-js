<template>
    <div>
     <headerComponent></headerComponent>         
   <div class="container">
          <router-view></router-view>
   </div>
   <br> <br> <br>
     <footer-component></footer-component>         
    </div>
</template>

<script>
import headerComponent from './components/headerComponent.vue';
import footerComponent from './components/footerComponent.vue';

    export default {
       components : {
           headerComponent,footerComponent
       }
    }
</script>
