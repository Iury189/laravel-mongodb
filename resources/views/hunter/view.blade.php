@extends('templates.template_hunter')
@section('title', "Visualizar $hunter->nome_hunter")
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar {{ $hunter->nome_hunter }}
                            <a href=" {{ url("/") }} " class="btn btn-secondary float-end" title="Retornar listagem"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </h4>
                    </div>
                </div>
                <br>
                <div class="card-body">
                    <!-- Form -->
                    <form action="#" method="POST">
                        {{ method_field('PATCH') }} {{ csrf_field() }}
                        <div class="form_group">
                            <div class="form_group">
                                <div for="nome_hunter">Nome:
                                    <input type="text" class="form-control @error('nome_hunter') is-invalid @enderror" name="nome_hunter" placeholder="Digite o nome do Hunter" maxlength="50" value="{{ $hunter->nome_hunter }}" readonly>
                                    @error('nome_hunter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="idade_hunter">Idade:
                                    <input type="text" class="form-control @error('idade_hunter') is-invalid @enderror" name="idade_hunter" placeholder="Digite a idade do Hunter" onkeypress="$(this).mask('00', {reverse: true});" value="{{ $hunter->idade_hunter }}" readonly>
                                    @error('idade_hunter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="altura_hunter">Altura:
                                    <input type="text" class="form-control @error('altura_hunter') is-invalid @enderror" name="altura_hunter" placeholder="Digite a altura do Hunter" onkeypress="$(this).mask('0.00', {reverse: true});" value="{{ $hunter->altura_hunter }}" readonly>
                                    @error('altura_hunter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="peso_hunter">Peso:
                                    <input type="text" class="form-control @error('peso_hunter') is-invalid @enderror" name="peso_hunter" placeholder="Digite o peso do Hunter" onkeypress="$(this).mask('000.00', {reverse: true});" value="{{ $hunter->peso_hunter }}" readonly>
                                    @error('peso_hunter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="tipo_hunter_id">Tipo de Hunter:
                                    <select class="form-control @error('tipo_hunter_id') is-invalid @enderror" name="tipo_hunter_id" disabled>
                                        <option {{ $hunter->tipo_hunter_id == '' ? 'selected' : '' }} value="">{{ __('Escolha o tipo de Hunter') }}</option>
                                        @foreach($tipo_hunter as $th)
                                            <option {{ $hunter->tipo_hunter_id == $th->_id ? 'selected' : '' }} value="{{ $th->_id }}">{{ $th->descricao }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_nen_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="tipo_nen_id">Tipo de Nen:
                                    <select class="form-control @error('tipo_nen_id') is-invalid @enderror" name="tipo_nen_id" disabled>
                                        <option {{ $hunter->tipo_nen_id == '' ? 'selected' : '' }} value="">{{ __('Escolha o tipo de nen') }}</option>
                                        @foreach($tipo_nen as $tn)
                                            <option {{ $hunter->tipo_nen_id == $tn->_id ? 'selected' : '' }} value="{{ $tn->_id }}">{{ $tn->descricao }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_nen_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="tipo_sangue_id">Tipo sanguíneo:
                                    <select class="form-control @error('tipo_sangue_id') is-invalid @enderror" name="tipo_sangue_id" disabled>
                                        <option {{ $hunter->tipo_sangue_id == '' ? 'selected' : '' }} value="">{{ __('Escolha o tipo sanguíneo') }}</option>
                                        @foreach($tipo_sanguineo as $ts)
                                            <option {{ $hunter->tipo_sangue_id == $ts->_id ? 'selected' : '' }} value="{{ $ts->_id }}">{{ $ts->descricao }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipo_sangue_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-group">Início:
                                <input class="form-control @error('inicio') is-invalid @enderror" name="inicio" type="date" min="<?php echo date('Y-m-d'); ?>" value="{{ $hunter->inicio }}" readonly/>
                                @error('inicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <div class="form-group">Término:
                                <input class="form-control @error('termino') is-invalid @enderror" name="termino" type="date" min="<?php echo date('Y-m-d'); ?>" value="{{ $hunter->termino }}" readonly/>
                                @error('termino')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="container">
        <div class="row">
            <div class="col text-center">
                <em> Iury Fernandes, {{ date('Y') }}.</em>
            </div>
        </div>
    </footer>
@endsection
