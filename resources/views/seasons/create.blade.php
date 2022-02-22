@extends('layouts.app')
@section('title') Séries | Adicionar nova @endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="mb-2">
                <h1>Adicionar nova série</h1>
            </div>
            @if ($errors->any())
                <div class="row">
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            
            @if( $action == 'create' )
                <form class="row g-2 needs-validation" action="{{ route('series.store') }}" method="post">
            @endif
            @if( $action == 'edit' )
                <form class="row g-2" action="{{ route('series.update', $serie->id) }}" method="post">
            @endif
                @csrf

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="col-5 form-floating mt-0">
                    <input type="text" class="form-control" name="title" id="validationCustom01" placeholder="Título da Série">
                    <label for="validationCustom01">Título da Série</label>
                    <div class="valid-feedback"> Looks good! </div>
                </div>
                <div class="col-3 form-floating mt-0">
                    <input type="number" class="form-control" name="seasons_quantity" id="validationCustom02" placeholder="Número de temporadas">
                    <label for="validationCustom02">Número de temporadas</label>
                    <div class="valid-feedback"> Looks good! </div>
                </div>
                <div class="col-3 form-floating mt-0">
                    <input type="number" class="form-control" name="episodes_quantity" id="validationCustom03" placeholder="Número de epsódios por temporada">
                    <label for="validationCustom03">Número de epsódios por temporada</label>
                    <div class="valid-feedback"> Looks good! </div>
                </div>
                <div class="col-auto m-auto">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </form>     
        </div>
    </section>
@endsection

@section('scripts')
@endsection