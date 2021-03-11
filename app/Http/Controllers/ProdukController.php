<?php

namespace App\Http\Controllers;
use App\News; 
use App\Pengumuman; 
use App\Produk; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProdukController extends Controller
{
    public function index(request $request){
        $menu='Produk';
        
        return view('produk.index',compact('menu'));
    }
    public function ubah(request $request){
        $data=Produk::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" value="'.$data['name'].'" placeholder="Isi disini">
            </div>
            <div class="form-group">
              <label>Kategori Produk</label>
              <select name="kategori_produk_id" class="form-control"  placeholder="Isi disini">
                  <option value="">Pilih Kategori---</option>';
                  foreach(kategori_produk() as $kategori){
                    if($data['kategori_produk_id']==$kategori['id']){$cek='selected';}else{$cek='';}
                    echo'<option value="'.$kategori['id'].'" '.$cek.'>'.$kategori['name'].'</option>';
                  }
                  echo'
              </select>
            </div>
            <div class="form-group">
                <label>Isi</label>
                
                <textarea class="textarea1" name="isi" placeholder="Ketikan isi disini......" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                '.$data['isi'].'
                </textarea>
                
            </div>
            <div class="form-group">
                <label>Gambar</label>';
                if($data['gambar']==''){
                    echo'<input type="file" name="file" class="form-control"  placeholder="Isi disini">';
                }else{
                    echo'<img src="'.url(link_direktory().'file/produk/'.$data['gambar']).'" class="gambar-news">
                    <span class="btn btn-danger btn-xs" onclick="hapus_gambar('.$data['id'].')"><i class="fa fa-remove"></i> Hapus</span>';
                }echo'
                
            </div>

        ';

        echo'
        <script>
            $(function () {
                $(".textarea1").wysihtml5();
            })
        </script>
        ';
    }
    public function view_data(request $request){
        $cek=strlen($request->name);
        echo'
            <table width="100%" class="table table-bordered" >
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Produk</th>
                    <th>Keterangan Produk</th>
                    <th width="15%">Kategori</th>
                    <th width="7%"></th>
                </tr>';
                if($cek>0){
                    $data=Produk::where('name','LIKE','%'.$request->name.'%')->orderBy('id','Desc')->get();
                }else{
                    $data=Produk::orderBy('id','Desc')->get();
                }
                
                foreach($data as $no=>$o){
                    echo'
                        <tr>
                            <td>'.($no+1).'</td>
                            <td>'.$o['name'].'</td>
                            <td>'.$o['isi'].'</td>
                            <td>'.cek_kategori_produk($o['kategori_produk_id']).'</td>
                            <td>
                                <span class="btn btn-success btn-xs" onclick="ubah('.$o['id'].')"><i class="fa fa-pencil"></i></span>_
                                <span class="btn btn-danger btn-xs" onclick="hapus('.$o['id'].')"><i class="fa fa-remove"></i></span>
                            </td>
                        </tr>
                    ';
                }
                echo'
            </table>
        ';
    }

    public function hapus_gambar(request $request){
        $data               = Barner::find($request->id);
        $data->gambar       = null;
        $data->save();

        echo $request->id;
    }
    public function hapus(request $request){
        $data= Barner::where('id',$request->id)->delete();

        echo 'ok';
    }
    public function simpan(request $request){
        error_reporting(0);
        if (trim($request->name) == '') {$error[] = '- Isi Nama Produk';}
        if (trim($request->kategori_produk_id) == '') {$error[] = '- Pilih kategori produk';}
        if (trim($request->isi) == '') {$error[] = '- Isi Keterangan produk';}
        if (trim($request->file) == '') {$error[] = '- Pilih Gambar Produk';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $patr='/\s+/';
            $link=preg_replace($patr,'_',$request->name);
            $file=$_FILES['file']['name'];
            $size=$_FILES['file']['size'];
            $asli=$_FILES['file']['tmp_name'];
            $ukuran=getimagesize($_FILES["file"]['tmp_name']);
            $tipe=explode('/',$_FILES['file']['type']);
            $filename=date('Ymdhis').'.'.$tipe[1];
            $lokasi=link_direktory().'file/produk/';
            if($tipe[0]=='image' && $size<=8000000 && $ukuran[0]==1170 && $ukuran[1]==500){
            
                if(move_uploaded_file($asli, $lokasi.$filename)){
                    $data               = New Produk;
                    $data->name         = $request->name;
                    $data->isi          = $request->isi;
                    $data->kategori_produk_id          = $request->kategori_produk_id;
                    $data->gambar       = $filename;
                    $data->save();
    
                    echo'ok';
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Upload gagal</p>';
                }
            }else{
                echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Ukuran file max 8mb</br>- Type file harus gambar </br> - Dengan Lebar 1170px dan tinggi 500px </p>';
            }

        }
    }
    public function simpan_ubah(request $request){
        error_reporting(0);
        if (trim($request->name) == '') {$error[] = '- Isi Nama Produk';}
        if (trim($request->kategori_produk_id) == '') {$error[] = '- Pilih kategori produk';}
        if (trim($request->isi) == '') {$error[] = '- Isi Keterangan produk';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $patr='/\s+/';
            $link=preg_replace($patr,'_',$request->name);
            if($request->file==''){
                $data               = Produk::find($request->id);
                $data->name         = $request->name;
                $data->kategori_produk_id         = $request->kategori_produk_id;
                $data->isi          = $request->isi;
                $data->save();

                echo'ok';
            }else{
                $file=$_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $asli=$_FILES['file']['tmp_name'];
                $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                $tipe=explode('/',$_FILES['file']['type']);
                $filename=date('Ymdhis').'.'.$tipe[1];
                $lokasi=link_direktory().'file/produk/';
                // if($tipe[0]=='image' && $size<=198640 && $ukuran[0]==1000 && $ukuran[1]==529){
                if($tipe[0]=='image' && $size<=8000000 && $ukuran[0]==1170 && $ukuran[1]==500){
                    if(move_uploaded_file($asli, $lokasi.$filename)){
                        $data               = Barner::find($request->id);
                        $data->name         = $request->name;
                        $data->isi          = $request->isi;
                        $data->kategori_produk_id         = $request->kategori_produk_id;
                        $data->gambar       = $filename;
                        $data->save();
        
                        echo'ok';
                    }else{
                        echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Upload gagal</p>';
                    }
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Ukuran file max 8mb</br>- Type file harus gambar </br> - Dengan Lebar 1170px dan tinggi 500px </p>';
                }
            }

        }

    }
}
