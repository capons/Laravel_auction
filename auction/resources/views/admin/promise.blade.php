@extends('admin')

@section('title', 'Заголовок страницы')

@section('sidebar')
@stop

@section('content')
	<script src="{!! asset('/AdminLTE/plugins/datatables/jquery.dataTables.min.js') !!}" type="text/javascript"></script>
	<link href="{!! asset('/AdminLTE/plugins/datatables/jquery.dataTables.min.css') !!}" rel="stylesheet" type="text/css">

	<p>Promise page</p>
@stop