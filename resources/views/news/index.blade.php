@extends('layouts.app_admin')

@section('content')
<section class="content">

      
    <div class="row">
          
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Bordered Table</h3>
          </div>
            <!-- /.box-header -->
          <div class="box-body">
              <span class="btn btn-primary btn-sm" onclick="tambah()"><i class="fa fa-pencil"></i> Tambah</span>
              <input type="text" placeholder="ketik............." class="form-control" onkeyup="cari_text(this.value)" style="width:50%;display:inline;height: 30px;float:right">
              <div id="tabledata" style="margin-top:2%"></div>
          </div>
            
        </div>
          
      </div>



    </div>
      

</section>

<div class="modal fade" id="modaltambah" style="display: none;">
  <div class="modal-dialog" style="width:80%;margin-top:0.3%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah</h4>
      </div>
      <div class="modal-body">
          <div id="notif"></div>
          <form method="post" action="{{url('/news/simpan')}}" id="my_simpan">
            @csrf
            <div class="form-group">
              <label>Judul</label>
              <input type="text" name="name" class="form-control"  placeholder="Isi disini">
            </div>
            <div class="form-group">
              <label>Isi</label>
              
              <textarea class="textarea" name="isi" placeholder="Ketikan isi disini......" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                  Cilegon, {{date('d/m/y')}} -
              </textarea>
              
            </div>
            <div class="form-group">
              <label>Gambar</label>
              <input type="file" name="file" class="form-control"  placeholder="Isi disini">
            </div>
            <input type="submit">
          </form>
      </div>
      <div class="modal-footer">
        <span  class="btn btn-default " data-dismiss="modal"><i class="fa fa-remove"></i> Batal</span>
        <span  class="btn btn-primary pull-left"  id="simpan" onclick="simpan()"><i class="fa fa-save"></i> Simpan</span>
        <span  class="btn btn-default pull-left"  id="simpan_proses" ><i class="fa fa-gear fa-spin"></i> Proses</span>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalubah" style="display: none;">
  <div class="modal-dialog" style="width:80%;margin-top:0.3%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah</h4>
      </div>
      <div class="modal-body">
          <div id="notif_ubah"></div>
          <form method="get" id="my_simpan_ubah">
            @csrf
            <div id="view_ubah"></div>
          </form>
      </div>
      <div class="modal-footer">
        <span  class="btn btn-default " data-dismiss="modal"><i class="fa fa-remove"></i> Batal</span>
        <span  class="btn btn-primary pull-left"  id="simpan_ubah" onclick="simpan_ubah()"><i class="fa fa-save"></i> Simpan</span>
        <span  class="btn btn-default pull-left"  id="simpan_ubah_proses" ><i class="fa fa-gear fa-spin"></i> Proses</span>
      </div>
    </div>
  </div>
</div>
@endsection

@push('ajax')
  <script>
      $(document).ready(function() {
        $('#simpan_proses').hide();
        $('#simpan_ubah_proses').hide();
        $.ajax({
            type: 'GET',
            url: "{{url('news/view_data')}}",
            data: "id=id",
            beforeSend: function(){
                $("#tabledata").html('<center><i class="fa fa-refresh fa-spin"></i> Proses Data.............</center>');
            },
            success: function(msg){
                $("#tabledata").html(msg);
                
            }
        }); 
      });

      $(function () {
        $('.textarea').wysihtml5();
      })
      
      function cari_text(a){
        $.ajax({
            type: 'GET',
            url: "{{url('news/view_data')}}",
            data: "name="+a,
            beforeSend: function(){
                $("#tabledata").html('<center><i class="fa fa-refresh fa-spin"></i> Proses Data.............</center>');
            },
            success: function(msg){
                $("#tabledata").html(msg);
                
            }
        }); 
      }
      function tambah(){
          $('#modaltambah').modal('show');
      }

      function ubah(a){
          $.ajax({
              type: 'GET',
              url: "{{url('news/ubah')}}",
              data: "id="+a,
              success: function(msg){
                $('#modalubah').modal('show');
                $('#view_ubah').html(msg);
                  
              }
          }); 
          
      }
      function hapus(a){
          $.ajax({
              type: 'GET',
              url: "{{url('news/hapus')}}",
              data: "id="+a,
              success: function(msg){
                location.reload();
                  
              }
          }); 
          
      }
      function hapus_gambar(a){
          $.ajax({
              type: 'GET',
              url: "{{url('news/hapus_gambar')}}",
              data: "id="+a,
              success: function(msg){
                $.ajax({
                    type: 'GET',
                    url: "{{url('news/ubah')}}",
                    data: "id="+msg,
                    success: function(data){
                      $('#modalubah').modal('show');
                      $('#view_ubah').html(data);
                        
                    }
                }); 
                  
              }
          }); 
          
      }

      function simpan(){
        var form=document.getElementById('my_simpan');
       
            $.ajax({
                type: 'POST',
                url: "{{url('/news/simpan')}}",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('#simpan').hide();
                    $('#simpan_proses').show();
                },
                success: function(msg){
                    
                    if(msg=='ok'){
                        location.reload();
                    }else{
                      $('#notif').html(msg);
                      $('#simpan').show();
                      $('#simpan_proses').hide();
                    }
                    
                    
                }
            });
      }

      function simpan_ubah(){
        var form=document.getElementById('my_simpan_ubah');
       
            $.ajax({
                type: 'POST',
                url: "{{url('/news/simpan_ubah')}}",
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('#simpan_ubah').hide();
                    $('#simpan_ubah_proses').show();
                },
                success: function(msg){
                    
                    if(msg=='ok'){
                        location.reload();
                    }else{
                      $('#notif_ubah').html(msg);
                      $('#simpan_ubah').show();
                      $('#simpan_ubah_proses').hide();
                    }
                    
                    
                }
            });
      }
      
  </script>
@endpush
