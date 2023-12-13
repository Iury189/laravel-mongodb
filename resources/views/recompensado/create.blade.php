@extends('templates.template_hunter')
@section('title', 'Cadastrar recompensa')
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Cadastrar recompensa
                            <a href="{{ url("rewarded") }}" class="btn btn-secondary float-end" title="Retornar listagem"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </h4>
                    </div>
                </div>
                <br>
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{ url("create-rewarded") }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form_group">
                            <div class="form_group">
                                <div for="recompensa_id">Recompensa:
                                    <select class="form-control @error('recompensa_id') is-invalid @enderror" name="recompensa_id">
                                        @if ($recompensa->isEmpty())
                                            <option>{{ __('Sem registros de recompensas') }}</option>
                                        @else
                                            <option {{ old('recompensa_id') == '' ? 'selected' : '' }} value="">{{ __('Escolha a recompensa') }}</option>
                                                @foreach($recompensa as $r)
                                                <option {{ old('recompensa_id') == $r->_id ? 'selected' : '' }} value="{{ $r->_id }}">{{ $r->descricao_recompensa }}</option>
                                            @endforeach
                                        @endif
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
                                    <select class="form-control @error('hunter_id') is-invalid @enderror" name="hunter_id">
                                        @if ($hunter->isEmpty())
                                            <option>{{ __('Sem registros de Fighters') }}</option>
                                        @else
                                            <option {{ old('hunter_id') == '' ? 'selected' : '' }} value="">{{ __('Escolha o Hunter') }}</option>
                                                @foreach($hunter as $h)
                                                <option {{ old('hunter_id') == $h->_id ? 'selected' : '' }} value="{{ $h->_id }}">{{ $h->nome_hunter }}</option>
                                            @endforeach
                                        @endif
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
                                    <input type="checkbox" class="@error('concluida') is-invalid @enderror" name="concluida" value="true" {{ old('concluida') == 'true' ? 'checked' : '' }}>
                                    Concluída
                                    @error('concluida')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success" title="Cadastrar"><i class="fa fa-plus"></i>&nbsp;Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtenha o botão "Cadastrar"
            const cadastrar_botao = document.querySelector('button[type="submit"]');

            // Adicione um evento de clique ao botão
            cadastrar_botao.addEventListener('click', function(event) {
                event.preventDefault(); // Impede o envio do formulário

                confirmDelete('Cadastrar Recompensa', 'Deseja cadastrar uma nova recompensa?'); // Modal de confirmação
            });

            function confirmDelete(title, text) {
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Continue com a ação
                        document.querySelector('form').submit();
                    }
                });
            }
        });
    </script>
    <!-- Footer -->
    <footer class="container">
        <div class="row">
            <div class="col text-center">
                <em> Iury Fernandes, {{ date('Y') }}.</em>
            </div>
        </div>
    </footer>
@endsection
