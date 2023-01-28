@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="{{route('panel')}}" class="bred">Home</a>
    <a href="{{route('brands.index')}}" class="bred">Marcas</a>
    <a href="{{route('brands.create')}}" class="bred">Cadastrar</a>
</div>

<a href="{{ route('brands.create') }}" class="btn btn-sucess">
    <i class="fa fa-plus-circle" aria-hidden="true"></i> Cadastrar
</a>

<div class="title-pg">
    <h1 class="title-pg">Gestão de Avião</h1>
</div>

<div class="content-din">

    @include('panel.includes.errors')

@if (isset($brand))
    <form class="form form-search form-ds" action="{{route('brands.update', $brand->id)}}" method="POST">
    {{method_field('PUT')}}
@else
    {{-- <form class="form form-search form-ds" action="{{route('brands.store')}}" method="POST"> --}}
    {!! Form::open(['route' => 'brands.store', 'class' => 'form form-search form-ds'])!!}
@endif

    <form class="form form-search form-ds" action="{{route('brands.store')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" value="{{old('name')}}" name="name" placeholder="Nome:" class="form-control">
        </div>

        <div class="form-group">
            <button class="btn btn-search">Enviar</button>
        </div>
    </form>

</div><!--Content Dinâmico-->

@endsection