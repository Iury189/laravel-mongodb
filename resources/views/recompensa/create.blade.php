@extends('templates.template_hunter')
@section('title', 'Cadastrar Recompensa')
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Cadastrar Recompensa
                            <a href="{{ url("reward") }}" class="btn btn-secondary float-end" title="Retornar listagem"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </h4>
                    </div>
                </div>
                <br>
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{ url("create-reward") }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form_group">
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
                                <div for="descricao_recompensa">Descrição:
                                    <input type="text" class="form-control @error('descricao_recompensa') is-invalid @enderror" name="descricao_recompensa" placeholder="Digite a descrição da recompensa" maxlength="50" value="{{ old('descricao_recompensa') }}">
                                    @error('descricao_recompensa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="valor_recompensa">Valor:
                                    <input type="text" class="form-control @error('valor_recompensa') is-invalid @enderror" name="valor_recompensa" placeholder="Digite o valor da recompensa" onkeypress="$(this).mask('0000000.00', {reverse: true});" value="{{ old('valor_recompensa') }}">
                                    @error('valor_recompensa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form_group">
                                <div for="concluida">Status:
                                    <select class="form-control @error('concluida') is-invalid @enderror" name="concluida">
                                        <option {{ old('concluida') === '' ? 'selected' : '' }} value="">Escolha uma opção</option>
                                        <option {{ old('concluida') === 'false' ? 'selected' : '' }} value="false">Não concluída</option>
                                        <option {{ old('concluida') === 'true' ? 'selected' : '' }} value="true">Concluída</option>
                                    </select>
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
