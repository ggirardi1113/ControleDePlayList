@extends('layouts.app')
@section('title','Criar nova Pasta')
@section('content')
<div class="container">
    <h1>Criar nova Pasta</h1>
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <br />
    {{Form::open(['route' => 'pasta.store', 'method' => 'POST','enctype'=>'multipart/form-data'])}}
        {{Form::label('nome', 'Nome')}}
        {{Form::text('nome','',['class'=>'form-control','required','placeholder'=>'Nome da Pasta'])}}
        {{Form::label('caminho_imagem', 'Foto')}}
        {{Form::file('caminho_imagem',['class'=>'form-control','id'=>'caminho_imagem'])}}
        <br />
        {{Form::submit('Salvar',['class'=>'btn btn-success'])}}
        {!!Form::button('Cancelar',['onclick'=>'javascript:history.go(-1)', 'class'=>'btn btn-secondary'])!!}
    {{Form::close()}}
</div>
@endsection
