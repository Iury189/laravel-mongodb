@extends('templates.template_hunter')
@section('title', "Visualizar recompensa de {{ $nome }}")
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar recompensa de {{ $recompensado->hunter->nome_hunter }}
                            <a href="{{ url("rewarded") }}" class="btn btn-secondary float-end" title="Retornar listagem"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </h4>
                    </div>
                </div>
                <br>
                <div class="card-body">
                    <!-- Form -->
                    <form action="#" method="POST">
                        {{ csrf_field() }}
                        <div class="form_group">
                            <div class="form_group">
                                <div for="recompensa_id">Recompensa:
                                    <select class="form-control @error('recompensa_id') is-invalid @enderror" name="recompensa_id" disabled>
                                        <option {{ $recompensado->recompensa_id == '' ? 'selected' : '' }} value="">{{ __('Escolha a recompensa') }}</option>
                                        @foreach($recompensa as $r)
                                            <option {{ $recompensado->recompensa_id == $r->_id ? 'selected' : '' }} value="{{ $r->_id }}">{{ $r->descricao_recompensa }}</option>
                                        @endforeach
                                    </select>
                                    @error('recompensa_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="hunter_id">Hunter:
                                    <select class="form-control @error('hunter_id') is-invalid @enderror" name="hunter_id" disabled>
                                        <option {{ $recompensado->hunter_id == '' ? 'selected' : '' }} value="">{{ __('Escolha o Hunter') }}</option>
                                        @foreach($hunter as $h)
                                            <option {{ $recompensado->hunter_id == $h->_id ? 'selected' : '' }} value="{{ $h->_id }}">{{ $h->nome_hunter }}</option>
                                        @endforeach
                                    </select>
                                    @error('hunter_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="concluida">Status:
                                    <input type="checkbox" class="@error('concluida') is-invalid @enderror" name="concluida" value="true" {{ $recompensado->concluida == true ? 'checked' : '' }} disabled>
                                    Concluída
                                    @error('concluida')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
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
