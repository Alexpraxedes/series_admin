@extends('layouts.app')
@section('title') Séries | Adicionar nova @endsection

@section('content')
    <section class="container">
        <div class="row justify-content-center">
            <div class="topo mb-2">
                <h1>Adicionar nova série</h1>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('series.index') }}" class="btn btn-outline-secondary" rel="noopener noreferrer">Cancelar</a>
                </div>
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
                <form class="row g-2 needs-validation" action="{{ route('series.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="col-5 form-floating mt-0">
                    <input class="form-control" type="file" id="formFile" name="image">
                    <label for="formFile" class="form-label">Capa da série</label>
                </div>
                <div class="col-7 form-floating mt-0">
                    <input type="text" class="form-control" name="title" id="validationCustom01" placeholder="Título da Série">
                    <label for="validationCustom01">Título da Série</label>
                </div>
                <div class="col-5 form-floating mt-2">
                    <input type="number" class="form-control" name="seasons_data" id="validationCustom02" placeholder="Número de temporadas">
                    <label for="validationCustom02">Número de temporadas</label>
                </div>
                <div class="col-5 form-floating mt-2">
                    <input type="number" class="form-control" name="episodes_data" id="validationCustom03" placeholder="Número de episódios por temporada">
                    <label for="validationCustom03">Número de episódios por temporada</label>
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