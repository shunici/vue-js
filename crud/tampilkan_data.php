harap pengaturan model sudah disiapkan

route//
Route::get('/home', 'HomeController@index')->name('home');

//controller
use App\profil;
   public function index()
    {
        return view('home');
    }

// home blade
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">        
                     @livewire('profil.data')
                </div>              
            </div>
        </div>
    </div>
</div>


//data blade komponen livewire
<div>
  <table class="table">
      <thead>
          <tr>
              <th>no</th>
              <th>nama</th>
              <th>keterampilan</th>
              <th>aksi</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($items as $item)      
          <tr>
              <td scope="row">{{$item->id}}</td>
          <td>{{$item->nama}}</td>
              <td>{{$item->keterampilan}}</td>
              <td>
                  <a href="#">edit</a> |
                  <a href="#">delete</a>
              </td>
          </tr>  
          @endforeach     
      </tbody>
  </table>
</div>

//data livewire di controller

use App\profil;
public $items;
    public function render()
    {
      
        $this->items = profil::all();
        return view('livewire.profil.data');
    }

