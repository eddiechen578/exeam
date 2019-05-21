@extends('layouts.front')

@section('title', '錯誤')

@section('content')

    @card
    @slot('header', '錯誤')
    <div class="text-center py-5">
        <h1 class="mb-4">{{ $msg }}</h1>
        <a class="btn btn-primary" href="{{route('merchandise.index')}}">返回首頁</a>
    </div>
    @endcard

@endsection