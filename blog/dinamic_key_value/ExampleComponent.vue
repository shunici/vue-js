<template>
    <div class="container mt-4">
      <h2 class="text-center mt-4 mb-4">Kita akan membuat data key dan value yang dihadirkan secara dinamis</h2>
        <div class="row ">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                         
                       
                          <div class="list-group" v-for="(item, index) in data" :key="index">
                            <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                              <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Judul : {{item.judul}}</h5>                                
                              </div>
                                <span v-for=" (data, index1) in ubah_json(item.data) " :key=" '1' + index1 ">   <!-- menghasilkan object  -->                         
                                     <p class="mb-1" v-for=" (value, name,  index2) in data" :key=" '2' +index2 ">  <!-- lopping objeck -->
                                        {{name}}:  {{value}}
                                      </p>     
                                </span>     
                                <button @click.prevent="edit(item.id)">Edit</button>                   
                            </a>                          
                          </div> 
                   
                   

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-header">    Data Add</div>                
                  <div class="card-body">
           
                     
                      <input type="text" class="form-control" placeholder="judul" v-model="db.judul">
                      <hr>
                      <div class="row">
                        <div class="col-md-3">
                            <span v-for="(value, key) in keynya" :key="key">                             
                            <input type="text" class="form-control" placeholder="key1" v-model="keynya[key]">
                            </span>

                        </div>
                        
                        <div class="col-md-9">
                          <span  v-for="(value, key) in keynya" :key="'1'+key">
                            <input type="text" class="d-inline form-control" style="width : 130px" placeholder="value1" v-model="valuenya[key]">
                            <button @click="hapus(key)">Hapus</button>
                            </span>
                        </div>
                        
                      </div>                                                                                                       
                      
                      
                       <button @click="tambah">Tambah</button>  <br> <hr>                                                        
                    <button class="float-right" @click="simpan">Simpan</button>

                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-header">    Data Edit</div>                
                  <div class="card-body">    
                      <input type="text" placeholder="judul" v-model="db.judul">                            
                     <div class="form-inline" v-for="(value, name) in db.dataJson[0]" :key="value">                        
                         <label for="" class="mr-4">{{name}}  </label>
                         <input type="text" name="" id="" class="form-control" placeholder="judul" v-model.lazy="db.dataJson[0][name]" >                                    
                     </div>
                <br>
    <input type="text">
          <!-- {{db.dataJson}} -->
                    <button class="float-right" @click="update">Update</button>

                  </div>
                </div>
            </div>
        </div> <!-- row-justifi -->
    </div>
</template>
 
<script>
  
    export default {
         
            data () {
                return {
                  data : '',
                  keynya :['roa', 'tes'],
                  valuenya : ['isi', 'isi'],
                  dataJson : [],
                  id : '',
                  db : {
                    judul : '',
                    dataJson : [], //kalo kurawal tidak bisa di push
                     //dtjson ini lah tempat dinanamic key valuenya
                  }
                  
                    
                }
            },
               created () {
              this.load_data()        
            }, 
            methods : {
              tambah(){
                  this.keynya.push('');
                  this.valuenya.push('');
              },
              hapus(index){
                this.keynya.splice(index, 1);
                this.valuenya.splice(index, 1);
              },
               simpan(){                           
                  var key = this.keynya;
                  var value = this.valuenya;
                  var i = 0;
                  var tes ={};
                  for( i; i < key.length; i++) {
                      tes[key[i] ] = value[i];
                  }
                
                  this.db.dataJson.push(tes);                

                 axios.post('/data', {params : {
                   judul : this.db.judul,
                   data : JSON.stringify(this.db.dataJson)
                 }})
                  .then((response) => {
                    console.log(response.data)                    
                    })  
                    this.load_data();
                  
              },
              load_data(){  
                  axios.get('/data').then( (response) => {              
                  this.data = response.data;
                })   
              },
              ubah_json(param){               
                return JSON.parse(param);
              },
              edit (id) {
                this.id = id;
                    axios.get(`/data/${id}/edit`)
                    .then( (response) => {
                        // console.log(response.data)
                        var edit = response.data.data;
                        
                        this.db.judul = edit.judul
                        this.db.dataJson = JSON.parse(edit.data);
                    })
              },
              update() {
            
                 axios.put(`/data/${this.id}`, {params : {
                   judul : this.db.judul,
                   data : JSON.stringify(this.db.dataJson)
                 }})
                  .then((response) => {
                    console.log(response.data)                    
                    })  
                    this.load_data();
              }
            }      
 
 
    }
</script>


