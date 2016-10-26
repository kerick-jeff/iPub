@extends('layouts.extendable')

@section('extendable_content')
<div class="container-fluid" style="margin-left: -70px; margin-right: -15px">
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
    <img src="{{ asset('images/land2.jpg') }}" alt="landing_page" style="max-width: 100%;" />
    </div>
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(window).load(function(){
            $('#followModal').modal('show');
        });
    </script>
@endsection
