<?php

namespace App\Http\Controllers;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NewsController extends Controller
{
    public function index(request $request){
        $menu='News';
        
        return view('news.index',compact('menu'));
    }
    public function ubah(request $request){
        $data=News::where('id',$request->id)->first();
        echo'
            <input type="hidden" name="id" value="'.$data['id'].'">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="name" class="form-control" value="'.$data['name'].'" placeholder="Isi disini">
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
                    echo'<img src="'.url(link_html().'file/news/'.$data['gambar']).'" class="gambar-news">
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
                    <th>Judul</th>
                    <th width="10%">Tanggal</th>
                    <th width="7%">Aktif</th>
                    <th width="9%">Dilihat</th>
                    <th width="7%"></th>
                </tr>';
                if($cek>0){
                    $data=News::where('name','LIKE','%'.$request->name.'%')->orderBy('id','Desc')->get();
                }else{
                    $data=News::orderBy('id','Desc')->get();
                }
                
                foreach($data as $no=>$o){
                    echo'
                        <tr>
                            <td>'.($no+1).'</td>
                            <td>'.$o['name'].'</td>
                            <td>'.$o['tanggal_lengkap'].'</td>
                            <td>'.sts($o['sts']).'</td>
                            <td><span class="badge bg-red">55%</span></td>
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
        $data               = News::find($request->id);
        $data->gambar       = null;
        $data->save();

        echo $request->id;
    }
    public function hapus(request $request){
        $data= News::where('id',$request->id)->delete();

        echo 'ok';
    }
    public function simpan(request $request){
        error_reporting(0);
        if (trim($request->name) == '') {$error[] = '- Isi Judul Berita';}
        if (trim($request->isi) == '') {$error[] = '- Isi Keterangan berita';}
        if (trim($request->file) == '') {$error[] = '- Pilih Gambar';}
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
            $lokasi=link_html().'file/news/';
            // if($tipe[0]=='image' && $size<=198640 && $ukuran[0]==1000 && $ukuran[1]==529){
            if($tipe[0]=='image' && $size<=198640){
                if(move_uploaded_file($asli, $lokasi.$filename)){
                    $data               = New News;
                    $data->name         = $request->name;
                    $data->isi          = $request->isi;
                    $data->link          = $link;
                    $data->tanggal      = date('Y-m-d');
                    $data->sts          = 0;
                    $data->tanggal_lengkap  = date('Y-m-d H:i:s');
                    $data->gambar       = $filename;
                    $data->save();
    
                    echo'ok';
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Upload gagal</p>';
                }
            }else{
                echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Ukuran file max 200kb</br>- Type file harus gambar </br> - Dengan Lebar dan tinggi '.$size.'</p>';
            }

        }
    }
    public function simpan_ubah(request $request){
        error_reporting(0);
        if (trim($request->name) == '') {$error[] = '- Isi Judul Berita';}
        if (trim($request->isi) == '') {$error[] = '- Isi Keterangan berita';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $patr='/\s+/';
            $link=preg_replace($patr,'_',$request->name);
            if($request->file==''){
                $data               = News::find($request->id);
                $data->name         = $request->name;
                $data->isi          = $request->isi;
                $data->link          = $link;
                $data->save();

                echo'ok';
            }else{
                $file=$_FILES['file']['name'];
                $size=$_FILES['file']['size'];
                $asli=$_FILES['file']['tmp_name'];
                $ukuran=getimagesize($_FILES["file"]['tmp_name']);
                $tipe=explode('/',$_FILES['file']['type']);
                $filename=date('Ymdhis').'.'.$tipe[1];
                $lokasi=link_html().'file/news/';
                // if($tipe[0]=='image' && $size<=198640 && $ukuran[0]==1000 && $ukuran[1]==529){
                if($tipe[0]=='image' && $size<=198640){
                    if(move_uploaded_file($asli, $lokasi.$filename)){
                        $data               = News::find($request->id);
                        $data->name         = $request->name;
                        $data->isi          = $request->isi;
                        $data->link          = $link;
                        $data->gambar       = $filename;
                        $data->save();
        
                        echo'ok';
                    }else{
                        echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Upload gagal</p>';
                    }
                }else{
                    echo '<p style="font-size:12px;padding:5px;background:#d1ffae"><b>Error</b>: <br />- Ukuran file max 200kb</br>- Type file harus gambar </br> - Dengan Lebar dan tinggi 1000X529</p>';
                }
            }

        }

    }
}
