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

            @include( 'layouts.message', ['message' => $message] )

            <div>
                <table class="table table-hover">
                    <thead class="table-secondary">
                        <tr class="">
                            <th class="col-1">Imagem</th>
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
                                <th class="col-1">
                                    <figure class="figure">
                                        <img src="img/series/{{ $serie->image }}" alt="{{ $serie->title }}" class="figure-img img-fluid rounded">
                                    </figure>
                                </th>
                                <td class="col">
                                    <p id="serie-{{ $serie->id }}" class="pt-1 m-auto"><b>{{ $serie->title }}</b></p>
                                    <span class="badge bg-secondary">
                                        Temporadas <span class="badge bg-light text-dark">{{ $serie->seasons->count() }}</span>
                                    </span>
                                    <span class="badge bg-info">
                                        Episódios <span class="badge bg-light text-dark">{{ $serie->seasons->getWatchedEpisodes()->count() }} / {{ $serie->seasons->getAllEpisodes()->count() }}</span>
                                    </span>
                                </td>
                                <td class="col-1 p-0">
                                    <div class="col-auto btn-group btn-group-sm p-1 mt-3" role="group">
                                        <a href="{{ route('seasons.show', [$serie->uuid]) }}" type="button" class="btn btn-outline-secondary rounded-0 rounded-start align-items-center d-flex fs-5 p-2">
                                            <i data-fa-symbol="view" class="fa-regular fa-eye"></i>
                                        </a>
                                        <a href="{{ route('series.edit', [$serie->uuid]) }}" type="button" class="series-edit btn btn-outline-secondary rounded-0 align-items-center d-flex fs-5 p-2" style="margin-right: -1px;">
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

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.series-edit').click(function(){
                let serieId = $(this).attr('value');
                if( $('#serie-'+serieId).css('display') == 'none' )
                {
                    $('#serie-'+serieId).css('display', 'block');
                    $('#serie-input-'+serieId).css('display', 'none');
                } else
                {
                    $('#serie-input-'+serieId).css('display', 'flex');
                    $('#serie-'+serieId).css('display', 'none');
                }
            });
        });
    </script> 
@endsection