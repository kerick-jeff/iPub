@extends('layouts.extendable')

@section('extendable_content')
<div class="container-fluid" style="margin-left: -70px; margin-right: -15px;">
    <div class="row">
        @if(session('follow'))
          <!-- follow status modal -->
          <div class="modal fade" id = "followModal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{ session('followHeader') }}</h4>
                  </div>
                  <div class="modal-body">
                    <p> {{ session('follow') }} </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
          </div>
        @endif

    </div>
</div>

<footer class="main-footer" style = "margin-left: 0px; position: fixed; bottom: 0px; left: 0px; right: 0px">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.1
  </div>
  <strong>Copyright &copy; {{ date('Y') }} <a href="/">iPub.com</a>.</strong> All rights reserved.
</footer>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(window).load(function(){
            $('#followModal').modal('show');
        });
    </script>
@endsection
