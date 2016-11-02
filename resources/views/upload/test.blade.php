@foreach( $pubs as $pub)
	{{ $pub }}
	<br><br>
@endforeach





        $('#box').onclick('#deleteButton', function(e){
           var id = $('#alertDelete #id').val($(e.relatedTarget).data('id'));
           $('#deleteForm').attr("action", "photo/" + id + "/destroy" );
        });