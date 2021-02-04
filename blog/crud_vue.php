api.php
<?php

Route::get('/klub', 'klubController@index');
Route::post('/create-klub', 'klubController@create');
Route::get('/klub/{id}', 'klubController@edit');
Route::post('/update/{id}', 'klubController@update');

////////////////////////

klub.php (model db)

class klub extends Model
{
    protected $fillable = [
        'nama',
        'manajer',
        'total_pemain',
        'liga'
    ];
}

///////////=======

klubController

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\klub;
class klubController extends Controller
{
    public function index ()
    {
        $data = klub::all();
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data =DB::table('klubs')->insert($request->all());
        return response()->json("data berhasil disimpan");
    }
    public function edit($id)
    {
        $data = DB::table('klubs')->where('id', $id)->first();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = DB::table('klubs')
        ->where('id', $id)
        ->update($request->all());
        return response()->json('berhasil');
    }
}

==============
web.php

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');

==============
resources/views index.blade.php

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- boostrap vue -->

<!-- Load required Bootstrap and BootstrapVue CSS -->
<link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.css" />

<!-- Load polyfills to support older browsers -->
<script src="//polyfill.io/v3/polyfill.min.js?features=es2015%2CIntersectionObserver" crossorigin="anonymous"></script>

<!-- Load Vue followed by BootstrapVue -->
<script src="//unpkg.com/vue@latest/dist/vue.min.js"></script>
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.min.js"></script>

<!-- Load the following for BootstrapVueIcons support -->
<script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue-icons.min.js"></script>
<!-- end boostrap vue -->
<link rel="stylesheet" href="{{asset('/css/app.css')}}">
<link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <title>Document</title>

</head>
<body>
   <div id="app">
    <app></app>
   </div>
   <script src="/js/app.js"></script>
</body>
</html>


===============khusus resources/js=========

router.js

<script>

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


//pages
const Home = require('./pages/home.vue').default;
import klubComponen from './pages/klub/klub.vue'
import indexKlub from './pages/klub/index.vue'
import createKlub from './pages/klub/create.vue'
//ini bagian yang kita tambahkan
import editKlub from './pages/klub/edit.vue'


const routes = [   
    {
        path: '/home',
        name: 'home',
        component: Home,   
        meta: { title: 'home' }                    
    },
    {
        path : '/klub',
        name : 'klub',
        component : klubComponen,
        meta: { title : 'klub' }, 
         children: [
            {
                path: '',
                name: 'index.klub',
                component: indexKlub,
                meta: { title: 'index klub' }
            },    
                {
                    path: 'create',
                    name: 'create.klub',
                    component: createKlub,
                    meta: { title: 'create klub' }
                },
                {
                    //ini bagian yang kita tambahkan
                    path: 'edit/:data_id?',
                    name: 'edit.klub',
                    component: editKlub,
                    meta: { title: 'edit klub' }
                },          
            ]       
    }         
]

const router = new VueRouter ({
    mode : 'history',      
    routes : routes
});
router.beforeEach((to, from, next) => {
    document.title = to.meta.title

    next()
});

export default router

=================================
app.js


require('./bootstrap');
window.Vue = require('vue');
import App from './App.vue';


//ini mengarahkan ke file router.js
import router from './router.js'

const app = new Vue({
    el: '#app',
    router,
    components : {
        App
    }
   
});


</script>

===========================
App.vue
<template>
    <div>
     <navBar></navBar>         
       <router-view></router-view>
     <fooTer></fooTer>         
    </div>
</template>

<script>
import navBar from './components/navBar.vue';
import fooTer from './components/fooTer.vue';

    export default {
       components : {
           navBar,fooTer
       }
    }
</script>




=======================khusus component dll
components/navBar.vue
<template>
<div>
  <nav class="navbar navbar-expand-sm navbar-dark" style="background-color: black;">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
          aria-expanded="false" aria-label="Toggle navigation"></button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">            
              <li class="nav-item">
               <router-link :to="{name : 'home'}" class="nav-link">home</router-link>
              </li>  

                 <li class="nav-item">
                   <router-link :to="{name : 'index.klub'}" class="nav-link">klub</router-link>
                </li>          
          </ul>
     
      </div>
  </nav>
</div>
</template> 

====================
components / fooTer.vue

<template>
    <div>
        ini bagian footer
</div>
</template>

==================
pages/home.vue
<template>
    <div>
          sdfsdf
</div>
</template>

===============
pages/klub/index.vue
<template>
    <div>
        <h2>Nama klub dunia</h2>
     <router-link :to="{name : 'create.klub'}" class="btn btn-info">Tambah Data</router-link>
         <table class="table">                             
                <tr><th>No</th> <th>Nama</th> <th>Manajer</th> <th>Total Pemain</th> <th>Aksi</th> </tr>                                                                              

                <tr v-for="(item, index) in klub" :key="item" >
                <td>{{index+1}}</td>                              
                <td>{{item.nama}}</td>    
                <td>{{item.manajer}}</td>                           
                <th>{{item.total_pemain}}</th>
                <th>   <button @click.prevent='edit(item.id)'>edit</button>
                 <button @click.prevent='hapus(item.id, index)'>hapus</button> 
                    </th>
                </tr>
        </table>               
</div>
</template>

<script>
    export default {     
        data (){
            return {
                klub : [],
            }
        }, 
         mounted () {
            axios.get('/api/klub').then( (response) => {              
               this.klub = response.data;
            })           
        },
        methods : {
            
            edit(id) {
              this.$router.push({
                  name : 'edit.klub',
                  params : {data_id : id}
              })
            },
            
            hapus(id, id_sementara) {
                 axios.delete(`/api/delete/${id}`)
                 .then( (response) => {              
                   this.klub.splice(id_sementara, 1)
            }) 
            }
        }               
    }
</script>

==============
pages/klub/create.vue
<template>
    <div>
          <h2>Halaman Create</h2>
        <router-link :to="{name : 'index.klub'}" class="btn btn-info">Kembali</router-link>
        <form action="#">
            <input type="text" placeholder="masukkan nama klub" v-model="klub.nama">
            <input type="text" placeholder="manajer" v-model="klub.manajer">
            <input type="text" placeholder="total pemain" v-model="klub.total_pemain">
            <input type="text" placeholder="liga" v-model="klub.liga">
            <button v-on:click.prevent="buat()">Proses</button>
        </form>      
        
</div>
</template>

<script>
    export default {     
        data (){
            return {
                klub :{
                    nama : '',
                    manajer : '',
                    total_pemain : '',
                    liga : ''
                }
               
            }
        },        
        methods: {
            buat (){
                axios.post('/api/create-klub', this.klub)
               .then((response) => {
                console.log(response.data)    
                 this.$router.push("/klub");            
                })          
            }
        }
                    
    }
</script>

======================
pages/klub/edit.vue

<template>
    <div>
        <h2>Halaman Edit</h2>
   <router-link :to="{name : 'index.klub'}" class="btn btn-info">Kembali</router-link>
        <form action="#">
            <input type="text" placeholder="masukkan nama klub" v-model="klub.nama">
            <input type="text" placeholder="manajer" v-model="klub.manajer">
            <input type="text" placeholder="total pemain" v-model="klub.total_pemain">
            <input type="text" placeholder="liga" v-model="klub.liga">
        <button v-on:click.prevent="update()">Update</button>
        </form>  

        
    </div>
</template>

<script>
    export default {
        data () {
            return {
                klub : {}
            }
        },
        mounted () {
            var id = this.$route.params.data_id;
             axios.get(`/api/klub/${id}`)
             .then( (response) => {
                 console.log(response.data)
                return this.klub = response.data;
             })
         
        },
        methods : {
               
            update() {
                var id = this.$route.params.data_id;
                  axios.post(`/api/update/${id}`, this.klub)
                    .then( (response) => {
                        console.log(response.data)
                        return  this.$router.push({name : 'index.klub'});
                    })
            }
        }
       
    }
</script>
=================




