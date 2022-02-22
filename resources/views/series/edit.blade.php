@extends('layouts.app')
@section('title') Séries | Editar @endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="topo mb-2">
                <h1>Editando a série <b>{{ $serie->title }}</b></h1>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('series.index') }}" class="btn btn-outline-secondary" rel="noopener noreferrer">Voltar</a>
                </div>
            </div>

            @include( 'layouts.message', ['message' => $message] )

            <form class="row g-2" action="{{ route('series.update', $serie->uuid) }}" method="POST">
                @method('PUT')
                @csrf
                
                <div class="col-4 mt-0">
                    <img src="../../img/series/{{ $serie->image }}" alt="{{ $serie->title }}" class="figure-img img-fluid rounded">
                    <!-- <figcaption class="figure-caption">A caption for the above image.</figcaption> -->
                </div>
                <div class="col-8 form-floating mt-0">
                    <input type="text" class="form-control" name="title" id="validationCustom001" placeholder="Título da Série" value="{{ $serie->title }}">
                    <label for="validationCustom001">Título da Série</label>
                    
                    @foreach( $serie->seasons as $index => $season )
                        <div class="accordion mt-2" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}">
                                        Temporada {{ $index + 1 }} : {{ $season->data }} | {{ $season->episodes->count() }} Episódios | 
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body p-1">
                                        <div class="form-floating">
                                            <input type="text" class="form-control mb-1" name="season-{{ $season->id }}" id="validationCustom0{{ $season->id }}" placeholder="Título da Série" value="{{ $season->data }}">
                                            <label for="validationCustom0{{ $season->id }}">Título da temporada</label>
                                        </div>
                                        <div class="row">
                                            @foreach( $season->episodes as $key => $episode )
                                                <div class="col-12 col-sm-6 mb-1">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" name="episode-{{ $episode->id }}" id="validationCustom0{{ $episode->id }}" placeholder="Título da Série" value="{{ $episode->data }}">
                                                        <label for="validationCustom0{{ $episode->id }}">Episódio {{ $key + 1 }}</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault-{{ $episode->id }}" name="watched-{{ $episode->id }}" value="{{ $episode->watched }}"
                                                                @if( $episode->watched == 1) checked @endif value="{{ $episode->watched }}">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault-{{ $episode->id }}">Assistido</label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="col-auto m-auto mt-4">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>     
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.form-check-input').click( function(){
                let check = $(this).val();
                if( check == true )
                    $(this).val(false);
                else
                    $(this).val(true);
            });
        });
    </script> 
@endsection