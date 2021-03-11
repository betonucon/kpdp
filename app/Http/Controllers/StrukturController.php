<?php

namespace App\Http\Controllers;
use App\News; 
use App\Pengumuman; 
use App\Struktur; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StrukturController extends Controller
{
    public function index(request $request){
        $menu='Struktur Organisasi';
        
        return view('struktur.index',compact('menu'));
    }
    public function ubah(request $request){
        $data=Struktur::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <div class="form-group">
                <label>Nama </label>
                <input type="text" name="name" class="form-control" value="'.$data['name'].'" placeholder="Isi disini">
            
            
                <label>Jabatan </label>
                <input type="text" name="jabatan" class="form-control" value="'.$data['jabatan'].'" placeholder="Isi disini">
            
            
                <label>Tentang</label>
                
                <textarea class="textarea1" name="moto" placeholder="Ketikan isi disini......" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                '.$data['moto'].'
                </textarea>
            
                <label>Foto</label>';
                if($data['gambar']==''){
                    echo'<input type="file" name="file" class="form-control"  placeholder="Isi disini">';
                }else{
                    echo'<img src="'.url(link_direktory().'file/struktur/'.$data['gambar']).'" class="gambar-news">
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
                    <th width="15%">Jabatan</th>
                    <th width="15%">Nama</th>
                    <th>Informasi</th>
                    <th width="7%">Foto</th>
                    <th width="8%"></th>
                </tr>';
                if($cek>0){
                    $data=Struktur::where('name','LIKE','%'.$request->name.'%')->orderBy('urut','Desc')->get();
                }else{
                    $data=Struktur::orderBy('urut','Desc')->get();
                }
                
                foreach($data as $no=>$o){
                    echo'
                        <tr>
                            <td>'.($no+1).'</td>
                            <td>'.$o['jabatan'].'</td>
                            <td>'.$o['name'].'</td>
                            <td>'.$o['moto'].'</td>
                            <td><img src="'.url('file/struktur/'.$o['gambar']).'" style="width:100%"></td>
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
        $data               = Struktur::find($request->id);
        $data->gambar       = null;
        $data->save();

        echo $request->id;
    }
    public function hapus(request $request){
        $data= Struktur::where('id',$request->id)->delete();

        echo 'ok';
    }
    public function simpan(request $request){
        error_reporting(0);
        if (trim($request->name) == '') {$error[] = '- Isi Nama pimpinan';}
        if (trim($request->jabatan) == '') {$error[] = '- Isi Nama Jabatan';}
        if (trim($request->moto) == '') {$error[] = '- Isi Moto Pimpinan';}
        if (trim($request->file) == '') {$error[] = '- Pilih Foto Pimpinan';}
        if (trim($request->urut) == '') {$error[] = '- Isi Urutan Tampilam';}
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
            $lokasi=link_direktory().'file/struktur/';
            if($tipe[0]=='image' && $size<=8000000 && $ukuran[0]==160 && $ukuran[1]==231){
            
                if(move_uploaded_file($asli, $lokasi.$filename)){
                    $data               = New Struktur;
                    $data->name         = $request->name;
                    $data->jabatan          = $request->jabatan;
                    $data->urut          = $request->urut;
                    $data->moto          = $request->moto;
                    $data->gambar       = $filename;
                    $data->save();
    
                    echo'ok';
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Upload gagal</p>';
                }
            }else{
                echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Ukuran file max 8mb</br>- Type file harus gambar </br> - Dengan Lebar 160px dan tinggi 231px </p>';
            }

        }
    }
    public function simpan_ubah(request $request){
        error_reporting(0);
        if (trim($request->name) == '') {$error[] = '- Isi Nama pimpinan';}
        if (trim($request->jabatan) == '') {$error[] = '- Isi Nama Jabatan';}
        if (trim($request->moto) == '') {$error[] = '- Isi Moto Pimpinan';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $patr='/\s+/';
            $link=preg_replace($patr,'_',$request->name);
            if($request->file==''){
                $data               = Struktur::find($request->id);
                $data->name         = $request->name;
                $data->jabatan      = $request->jabatan;
                $data->moto         = $request->moto;
                $data->save();

                echo'ok';
            }else{
                $file=$_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $asli=$_FILES['file']['tmp_name'];
                $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                $tipe=explode('/',$_FILES['file']['type']);
                $filename=date('Ymdhis').'.'.$tipe[1];
                $lokasi=link_direktory().'file/struktur/';
                // if($tipe[0]=='image' && $size<=198640 && $ukuran[0]==1000 && $ukuran[1]==529){
                if($tipe[0]=='image' && $size<=8000000 && $ukuran[0]==1170 && $ukuran[1]==500){
                    if(move_uploaded_file($asli, $lokasi.$filename)){
                        $data               = Struktur::find($request->id);
                        $data->name         = $request->name;
                        $data->jabatan      = $request->jabatan;
                        $data->moto         = $request->moto;
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
