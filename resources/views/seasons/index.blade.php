@extends('layouts.app')
@section('title') Temporadas | Listar todas @endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="topo mb-2">
                <h1>Temporadas da série <b>{{ $serie->title }}</b></h1>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('series.index') }}" class="btn btn-outline-secondary" rel="noopener noreferrer">Voltar</a>
                </div>
            </div>
            
            <div>
                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr class="">
                            <th class="col-2">Temporadas</th>
                            <th class="col">Títulos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( $seasons == "[]" )
                            <tr>
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div> Nenhuma temporada cadastrada </div>
                                </div>
                        @else
                            @foreach( $seasons as $index => $season )
                            <tr class="align-items-center">
                                <th class="col-2"><p class="pt-1 m-auto">Temporada {{ $index + 1 }}</p></th>
                                <th class="col"><p class="pt-1 m-auto">Temporada {{ $season->data }}</p></th>
                                <!-- <td class="col-1 p-0">
                                    <div class="col-auto btn-group btn-group-sm p-1" role="group">
                                        <a href="{{ route('seasons.show', [$serie->uuid]) }}" type="button" class="btn btn-outline-secondary rounded-0 rounded-start align-items-center d-flex fs-5 p-2">
                                            <i data-fa-symbol="view" class="fa-regular fa-eye"></i>
                                        </a>

                                        <a href="{{ route('series.edit', [$serie->uuid]) }}" type="button" class="btn btn-outline-secondary rounded-0 align-items-center d-flex fs-5 p-2" style="margin-right: -1px;">
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
                                </td>-->
                            @endforeach
                        @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection