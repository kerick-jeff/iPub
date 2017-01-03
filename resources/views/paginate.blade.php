@extends('layouts.master')

@section('title', '| paginate')

<!-- provide author and page description -->

@section('breadcrumb')
<h1>
  Mailbox
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> iPub</a></li>
  <li>paginate</li>
  <li class="active">paginate</li>
</ol>
@endsection

@section('content')

<div class="container">
  @foreach($links as $link)
    <li>{{ $link->link." -- ".$link->caption }}</li>
  @endforeach
</div>
{!! $links->render() !!}
<!-- /.row -->

@endsection

@section('javascript')

@endsection
