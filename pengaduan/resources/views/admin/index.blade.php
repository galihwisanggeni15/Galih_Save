@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <section class="p-5">
        {{ session('user')->username }}
    </section>
@endsection
