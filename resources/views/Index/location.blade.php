@extends('layouts.app')
@section('title', '前台')
@section('content')
    <!-- cart -->
    <div class="cart section">
        <h3><center><a href="{{$redirect}}">{{$msg}}</a></center></h3>
    </div>
    <!-- end cart -->
@endsection
