@extends('layouts.app')
@section('title','Pasta - '.$pasta->nome)
@section('content')
    <div class="card w-50 m-auto">
        @php
            $nomeimagem = "";
            if(file_exists("./img/livros/".md5($pasta->id).".jpg")) {
                $nomeimagem = "./img/livros/".md5($pasta->id).".jpg";
            } elseif (file_exists("./img/livros/".md5($pasta->id).".png")) {
                $nomeimagem = "./img/livros/".md5($pasta->id).".png";
            } elseif (file_exists("./img/livros/".md5($pasta->id).".gif")) {
                $nomeimagem =  "./img/livros/".md5($pasta->id).".gif";
            } elseif (file_exists("./img/livros/".md5($pasta->id).".webp")) {
                $nomeimagem = "./img/livros/".md5($pasta->id).".webp";
            } elseif (file_exists("./img/livros/".md5($pasta->id).".jpeg")) {
                $nomeimagem = "./img/livros/".md5($pasta->id).".jpeg";
            } else {
                $nomeimagem = "./img/livros/livrosemfoto.webp";
            }
            //echo $nomeimagem;
        @endphp

        {{Html::image(asset($nomeimagem),'Foto de '.$pasta->nome,["class"=>"img-thumbnail w-75 mx-auto d-block"])}}

        <div class="card-header">
            <h1>Pasta - {{$pasta->nome}}</h1>
        </div>
        <div class="card-body">
                <h3 class="card-title">ID: {{$pasta->id}}</h3>
                <p class="text">Nome: {{$pasta->nome}}</p>
        </div>
        <div class="card-footer">
            @if ((Auth::check()) && (Auth::user()->isAdmin()))
                {{Form::open(['route' => ['pasta.destroy',$pasta->id],'method' => 'DELETE'])}}
                @if ($nomeimagem !== "./img/livros/livrosemfoto.webp")
                {{Form::hidden('foto',$nomeimagem)}}
                @endif
                <a href="{{url('playlist/'.$pasta->id.'/edit')}}" class="btn btn-success">Alterar</a>
                {{Form::submit('Excluir',['class'=>'btn btn-danger','onclick'=>'return confirm("Confirma exclusão?")'])}}
            @endif
            <a href="{{url('playlist/')}}" class="btn btn-secondary">Voltar</a>
            @if ((Auth::check()) && (Auth::user()->isAdmin()))
                {{Form::close()}}
            @endif
        </div>
    </div>
    <br />

@endsection
