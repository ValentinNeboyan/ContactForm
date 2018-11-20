@extends('layouts.app')

@section('content')

    @if(!Auth::user())
<div >
    <h3>Здравствуйте! Авторизуйтесь для продожения!</h3>
</div>
    @endif

    @endsection