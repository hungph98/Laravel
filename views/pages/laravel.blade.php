@extends('Layouts.master')
@section('NoiDung')
<!-- <h2>Laravel</h2>
<?php 
echo $KhoaHoc;
?> 
{{$KhoaHoc}} -->
@if($KhoaHoc != "")
{{ $KhoaHoc }}
@else
{{ "Không có khóa học" }}
@endif
@endsection