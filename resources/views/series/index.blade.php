@extends('layouts.app')
@section('title') Séries | Listar todas @endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="topo mb-2">
                <h1>Lista de séries</h1>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('series.create') }}" class="btn btn-outline-secondary" rel="noopener noreferrer">Adicionar</a>
                </div>
            </div>

            @if($message)
                <div>                  
                    <div class="alert alert-{{ $message['type'] }} d-flex align-items-center alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>{{ $message['body'] }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <div>
                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr class="">
                            <th class="col">Título da Série</th>
                            <th class="col-1 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( $series == "[]" )
                            <tr>
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div> Nenhuma série cadastrada </div>
                                </div>
                        @else
                            @foreach( $series as $serie )
                            <tr class="align-items-center">
                                <th class="col"><p class="pt-1 m-auto">{{ $serie->title }}</p></th>
                                <td class="col-1 p-0">
                                    <div class="col-auto btn-group btn-group-sm p-1" role="group">
                                        <a href="{{ route('series.destroy', [$serie->uuid]) }}" type="button" class="btn btn-outline-secondary rounded-0 rounded-start align-items-center d-flex fs-5 p-2">
                                            <i data-fa-symbol="edit" class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        <form method="POST" class="m-0" action="{{route('series.destroy', $serie->uuid) }}" onsubmit="return confirm('Deseja realmente excluir a série {{$serie->title}}?')" >
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-secondary rounded-0 rounded-end align-items-center d-flex fs-5 p-2">
                                                <i data-fa-symbol="delete" class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endforeach
                        @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection