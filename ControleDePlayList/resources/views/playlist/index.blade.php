@extends('layouts.app')

@section('title','Listagem de PlayLists')
@section('content')
<div class="container">
    <h1>Listagem de PlayLists</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-info">
            {{Session::get('mensagem')}}
        </div>
    @endif
    {{Form::open(['url'=>'playlist/buscar','method'=>'GET'])}}
        <div class="row">
                <div class="col-sm-3">
                    <a class="btn btn-success" href="{{url('playlist/create')}}">Criar</a>
                </div>
            <div class="col-sm-9">
                <div class="input-group ml-5">
                    @if($busca !== null)
                        &nbsp;<a class="btn btn-info" href="{{url('playlist/')}}">Todos</a>&nbsp;
                    @endif
                    {{Form::text('busca',$busca,['class'=>'form-control','required','placeholder'=>'buscar'])}}
                    &nbsp;
                    <span class="input-group-btn">
                        {{Form::submit('Buscar',['class'=>'btn btn-secondary'])}}
                    </span>
                </div>
            </div>
        </div>
    {{Form::close()}}
    <br />
    <table class="table table-striped">
        @foreach ($pasta as $pas)
            <tr>
                <td>
                    <a href="{{url('playlist/'.$pas->id)}}">{{$pas->titulo}}</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $pasta->links() }}
</div>
@endsection

