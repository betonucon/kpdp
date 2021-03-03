@extends('layouts.app_admin')

@section('content')
<section class="content">

      
    <div class="row">
          
      <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <input type="hidden" id="act" value="{{$req}}">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              
              <li class="@if($req=='visi') active @endif"><a href="#tab_2" data-toggle="tab" onclick="act('visi')">Visi Misi</a></li>
              <li class="@if($req=='corporate') active @endif"><a href="#tab_3" data-toggle="tab" onclick="act('corporate')">Corporate value</a></li>
              <li class="@if($req=='sertifikat') active @endif"><a href="#tab_4" data-toggle="tab" onclick="act('sertifikat')">Sertifikat</a></li>
              <li class="@if($req=='sekilas') active @endif"><a href="#tab_1" data-toggle="tab" onclick="act('sekilas')">Sekilas KPDP</a></li>
              <li class="@if($req=='kontak') active @endif"><a href="#tab_5" data-toggle="tab" onclick="act('kontak')">Kontak</a></li>
              <li class="pull-left header"><i class="fa fa-th"></i> List About KPDP</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane @if($req=='sekilas') active @endif" id="tab_1">
                <div class="box-body pad">
                  <div id="notif_sekilas"></div>
                  <form method="get" id="my_sekilas">
                    @csrf
                    <input type="hidden" name="kategori" value="sekilas">
                    <textarea class="textarea" name="name" placeholder="Ketikan isi disini......"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      {!!about('sekilas')['name']!!}
                    </textarea>
                  </form>
                  <span class="btn btn-primary btn-sm" id="simpan_sekilas" onclick="simpan_sekilas()"><i class="fa fa-save"></i> Simpan</span>
                  <span class="btn btn-default btn-sm" id="simpan_sekilas_proses" ><i class="fa fa-gear fa-spin"></i> Proses...</span>
                </div>
              </div>
              
              <div class="tab-pane @if($req=='visi') active @endif" id="tab_2">
                <div class="box-body pad">
                  <div id="notif_visi"></div>
                  <form method="get" id="my_visi">
                    @csrf
                    <input type="hidden" name="kategori" value="visi">
                    <textarea class="textarea_visi" name="name" placeholder="Ketikan isi disini......" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      {!!about('visi')['name']!!}
                    </textarea>
                  </form>
                  <span class="btn btn-primary btn-sm" id="simpan_visi" onclick="simpan_visi()"><i class="fa fa-save"></i> Simpan</span>
                  <span class="btn btn-default btn-sm" id="simpan_visi_proses" ><i class="fa fa-gear fa-spin"></i> Proses...</span>
                </div>
              </div>
              
              <div class="tab-pane @if($req=='corporate') active @endif" id="tab_3">
                <div class="box-body pad">
                  <div id="notif_corporate"></div>
                  <form method="get" id="my_corporate">
                    @csrf
                    <input type="hidden" name="kategori" value="sekilas">
                    <textarea class="textarea_corporate" name="name" placeholder="Ketikan isi disini......" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      {!!about('corporate')['name']!!}
                    </textarea>
                  </form>
                  <span class="btn btn-primary btn-sm" id="simpan_corporate" onclick="simpan_corporate()"><i class="fa fa-save"></i> Simpan</span>
                  <span class="btn btn-default btn-sm" id="simpan_corporate_proses" ><i class="fa fa-gear fa-spin"></i> Proses...</span>
                </div> 
              </div>
              <div class="tab-pane @if($req=='kontak') active @endif" id="tab_5">
                <div class="box-body pad">
                  <div id="notif_kontak"></div>
                  <form method="get" id="my_kontak">
                    @csrf
                    <input type="hidden" name="kategori" value="kontak">
                    <textarea class="textarea_kontak" name="name" placeholder="Ketikan isi disini......" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      {!!about('kontak')['name']!!}
                    </textarea>
                  </form>
                  <span class="btn btn-primary btn-sm" id="simpan_kontak" onclick="simpan_kontak()"><i class="fa fa-save"></i> Simpan</span>
                  <span class="btn btn-default btn-sm" id="simpan_kontak_proses" ><i class="fa fa-gear fa-spin"></i> Proses...</span>
                </div> 
              </div>
              <div class="tab-pane @if($req=='sertifikat') active @endif" id="tab_4">
                <div class="box-body pad">
                  <div id="notif_sertifikat"></div>
                  <form method="get" id="my_sertifikat">
                    @csrf
                    <input type="hidden" name="kategori" value="sertifikat">
                    <textarea class="textarea_sertifikat" name="name" placeholder="Ketikan isi disini......" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      {!!about('sertifikat')['name']!!}
                    </textarea>
                  </form>
                  <span class="btn btn-primary btn-sm" id="simpan_sertifikat" onclick="simpan_sertifikat()"><i class="fa fa-save"></i> Simpan</span>
                  <span class="btn btn-default btn-sm" id="simpan_sertifikat_proses" ><i class="fa fa-gear fa-spin"></i> Proses...</span>
                </div>
              </div>
              
            </div>
            
          </div>
          
        </div>



    </div>
      

</section>
@endsection

@push('ajax')
  <script>
      $(document).ready(function() {
        $('#simpan_sekilas_proses').hide();
        $('#simpan_visi_proses').hide();
        $('#simpan_corporate_proses').hide();
        $('#simpan_sertifikat_proses').hide();
        $('#simpan_kontak_proses').hide();
          var act=$('#act').val();

          if(act=='sekilas'){
           
          }

          if(act=='visi'){

          }

          if(act=='corporate'){

          }

          if(act=='serifikat'){

          }
      });

      $(function () {
        $('.textarea').wysihtml5();
        $('.textarea_visi').wysihtml5();
        $('.textarea_corporate').wysihtml5();
        $('.textarea_sertifikat').wysihtml5();
        $('.textarea_kontak').wysihtml5();
      })
      function act(a){
        window.location.assign("{{url('about')}}?act="+a)
      }

      function simpan_sekilas(){
        var form=document.getElementById('my_sekilas');
       
            $.ajax({
                type: 'POST',
                url: "{{url('/about/simpan_sekilas')}}",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('#simpan_sekilas').hide();
                    $('#simpan_sekilas_proses').show();
                },
                success: function(msg){
                    
                    if(msg=='ok'){
                        location.reload();
                    }else{
                      $('#notif_sekilas').html(msg);
                      $('#simpan_sekilas').show();
                      $('#simpan_sekilas_proses').hide();
                    }
                    
                    
                }
            });
      }
      function simpan_visi(){
        var form=document.getElementById('my_visi');
       
          $.ajax({
              type: 'POST',
              url: "{{url('/about/simpan_visi')}}",
              data: new FormData(form),
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function(){
                  $('#simpan_visi').hide();
                  $('#simpan_visi_proses').show();
              },
              success: function(msg){
                  
                  if(msg=='ok'){
                      location.reload();
                  }else{
                    $('#notif_visi').html(msg);
                    $('#simpan_visi').show();
                    $('#simpan_visi_proses').hide();
                  }
                  
                  
              }
          });
      }
      function simpan_corporate(){
        var form=document.getElementById('my_corporate');
       
          $.ajax({
              type: 'POST',
              url: "{{url('/about/simpan_corporate')}}",
              data: new FormData(form),
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function(){
                  $('#simpan_corporate').hide();
                  $('#simpan_corporate_proses').show();
              },
              success: function(msg){
                  
                  if(msg=='ok'){
                      location.reload();
                  }else{
                    $('#notif_corporate').html(msg);
                    $('#simpan_corporate').show();
                    $('#simpan_corporate_proses').hide();
                  }
                  
                  
              }
          });
      }
      function simpan_sertifikat(){
        var form=document.getElementById('my_sertifikat');
       
          $.ajax({
              type: 'POST',
              url: "{{url('/about/simpan_sertifikat')}}",
              data: new FormData(form),
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function(){
                  $('#simpan_sertifikat').hide();
                  $('#simpan_sertifikat_proses').show();
              },
              success: function(msg){
                  
                  if(msg=='ok'){
                      location.reload();
                  }else{
                    $('#notif_sertifikat').html(msg);
                    $('#simpan_sertifikat').show();
                    $('#simpan_sertifikat_proses').hide();
                  }
                  
                  
              }
          });
      }
      function simpan_kontak(){
        var form=document.getElementById('my_kontak');
       
          $.ajax({
              type: 'POST',
              url: "{{url('/about/simpan_kontak')}}",
              data: new FormData(form),
              contentType: false,
              cache: false,
              processData:false,
              beforeSend: function(){
                  $('#simpan_kontak').hide();
                  $('#simpan_kontak_proses').show();
              },
              success: function(msg){
                  
                  if(msg=='ok'){
                      location.reload();
                  }else{
                    $('#notif_kontak').html(msg);
                    $('#simpan_kontak').show();
                    $('#simpan_kontak_proses').hide();
                  }
                  
                  
              }
          });
      }
  </script>
@endpush
