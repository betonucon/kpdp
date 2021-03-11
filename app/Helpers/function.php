<?php

function link_html(){
    $data='http://admin.kreasiteknologi.com';

    return $data;
}

function link_direktory(){
    $data='/var/www/html/webkpdp-admin/public/';

    return $data;
}

function about($id){
    $data=App\About::where('kategori',$id)->first();
    return $data;
}

function kategori_produk(){
    $data=App\Kategoriproduk::orderBy('id','Desc')->get();

    return $data;
}

function cek_kategori_produk($id){
    $data=App\Kategoriproduk::where('id',$id)->first();

    return $data['name'];
}

function sts($id){
    if($id==0){
        $data='<i class="fa fa-check-circle"></i>';
    }
    if($id==1){
        $data='<i class="fa fa-check-circle-o"></i>';
    }
    return $data;
}





?>
