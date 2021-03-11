<?php

namespace App\Http\Controllers;
use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AboutController extends Controller
{
    public function index(request $request){
        $menu='About KPDP';
        if($request->act==''){
            $req='sekilas';
        }else{
            $req=$request->act;
        }
        
        return view('about.index',compact('menu','req'));
    }
    
    public function simpan_sekilas(request $request){
        if (trim($request->name) == '') {$error[] = '- Isi Infromasi sekilas perusahaan';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=About::where('kategori','sekilas')->count();
            if($cek>0){
                $data               = About::where('kategori','sekilas')->first();
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->save();

                echo'ok';
            }else{
                $data               = New About;
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->kategori     = 'sekilas';
                $data->save();

                echo'ok';
            }
        }
    }
    
    public function simpan_visi(request $request){
        if (trim($request->name) == '') {$error[] = '- Isi Infromasi visi perusahaan';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=About::where('kategori','visi')->count();
            if($cek>0){
                $data               = About::where('kategori','visi')->first();
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->save();

                echo'ok';
            }else{
                $data               = New About;
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->kategori     = 'visi';
                $data->save();

                echo'ok';
            }
        }
    }
    
    public function simpan_corporate(request $request){
        if (trim($request->name) == '') {$error[] = '- Isi Infromasi corporate perusahaan';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=About::where('kategori','corporate')->count();
            if($cek>0){
                $data               = About::where('kategori','corporate')->first();
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->save();

                echo'ok';
            }else{
                $data               = New About;
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->kategori     = 'corporate';
                $data->save();

                echo'ok';
            }
        }
    }

    public function simpan_kontak(request $request){
        if (trim($request->name) == '') {$error[] = '- Isi Infromasi kontak perusahaan';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=About::where('kategori','kontak')->count();
            if($cek>0){
                $data               = About::where('kategori','kontak')->first();
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->save();

                echo'ok';
            }else{
                $data               = New About;
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->kategori     = 'kontak';
                $data->save();

                echo'ok';
            }
        }
    }
    
    public function simpan_sertifikat(request $request){
        if (trim($request->name) == '') {$error[] = '- Isi Infromasi sertifikat perusahaan';}
        if (isset($error)) {echo '<p style="padding:5px;background:#d1ffae"><b>Error</b>: <br />'.implode('<br />', $error).'</p>';} 
        else{
            $cek=About::where('kategori','sertifikat')->count();
            if($cek>0){
                $data               = About::where('kategori','sertifikat')->first();
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->save();

                echo'ok';
            }else{
                $data               = New About;
                $data->name         = $request->name;
                $data->tanggal      = date('Y-m-d');
                $data->kategori     = 'sertifikat';
                $data->save();

                echo'ok';
            }
        }
    }
}
