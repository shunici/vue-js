install
npm install laravel-vue-pagination
https://github.com/gilbitron/laravel-vue-pagination

<?php
//route
Route::get('/profils', 'profilController@index');

//controller
 public function index ()
    {
        $data =DB::table('profils')->paginate(2);
        return response()->json($data);
    }
    
 html
   <div class="card">                                                                                                                                               
                          <table class="table">
                                  ini halaman user  
                             <tr><th>No</th> <th>Nama</th><th>Keterampilan</th> <th>Aksi</th> </tr>                                                                              
                     
                             <tr v-for="(item, index) in biodata.data" :key="item" >
                                 <td>{{index+1}}</td>
                                 <td> {{item.nama}}</td>
                                 <td>{{item.keterampilan}}</td>
                                 <td> 
                                      <button @click.prevent='edit_user(item.id)'>edit</button>                                     
                                     <button @click.prevent="hapus(item.id)">Hapus</button>
                               </td>
                             </tr>
                          </table>
                              <pagination :data="biodata" @pagination-change-page="getResults"></pagination>
                              <!-- <pagination :data="biodata">
                                <span slot="prev-nav">&lt; Previous</span>
                                <span slot="next-nav">Next &gt;</span>
                            </pagination> -->
                </div>
                <script>
    export default {     
        data (){
            return {
                biodata : [],
            }
        },              
        mounted () {
            axios.get('/api/profils').then( (response) => {
               this.biodata = response.data;
            }),
            this.getResults();
        },
        methods : {                        
            getResults(page = 1) {
			axios.get('/api/profils?page=' + page)
				.then(response => {
					this.biodata = response.data;
				});
		    }
        }
    }
</script>
