@extends('layouts.master')

@section('content')
    <h1> 자식 yarou</h1>
@endsection

@section('style')       
    <style>
    body{background:green; color:white;}
    </style>
@stop
@section('foot')
    @include('subview.footer')
@stop
@section('script')
<script>
    alert('자식의 스크립트 섹션임');
</script>
@stop