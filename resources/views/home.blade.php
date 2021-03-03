@extends('layouts.app_admin')

@section('content')
<section class="content">

      
    <div class="row">
          
      <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#tab_1-1" data-toggle="tab">Tab 1</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Tab 2</a></li>
              <li><a href="#tab_3-2" data-toggle="tab">Tab 3</a></li>
              
              <li class="pull-left header"><i class="fa fa-th"></i> Custom Tabs</li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3-2">
                
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>



    </div>
      

</section>
@endsection
