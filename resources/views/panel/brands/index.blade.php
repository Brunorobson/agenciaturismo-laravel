@extends('panel.layouts.app')

@section('content')

<div class="bred">
    <a href="" class="bred">Home</a>
    <a href="" class="bred">Marcas</a>
</div>

<a href="{{ route('brands.create') }}" class="btn btn-sucess">
    <i class="fa fa-plus-circle" aria-hidden="true"></i> Cadastrar
</a>

<div class="title-pg">
    <h1 class="title-pg">Marcas de Aviões</h1>
</div>

<div class="content-din bg-white">

    <div class="form-search">
            {!! Form::open(['route' => 'brands.search', 'class' => 'form form-inline'])!!}
            {!! Form::text('key_search', null,['class' => 'form-control', 'placeholder' => 'Buscar por Marcas'])!!}

            <button class="btn btn-search">Pesquisar</button>
            {!!Form::close()!!}
        </form>
    </div>

    <div class="class-btn-insert">
        <a href="{{route('brands.create')}}" class="btn-insert">
            <span class="glyphicon glyphicon-plus"></span>
            Cadastrar
        </a>
    </div>
    
    <table class="table table-striped">
        <tr>
            <th>Nome</th>
            <th width="150">Ações</th>
        </tr>

        @forelse($brands as $brand)

        <tr>
                <td>{{$brand->name}}</td>
                <td>
                    <a href="{{route('brands.edit', $brand->id)}}" class="edit">Editar</a>
                    <a href="{{route('brands.show', $brand->id)}}" class="delete">Visualizar</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="200">Nenhum item cadastrado!</td>
            </tr>
        @endforelse
    </table>
    @if ( @isset($dataForm))
    {!! $brands->appends($dataForm)->links() !!}
    @else
    {!! $brands->links() !!}
    @endif
    
</div><!--Content Dinâmico-->

@endsection