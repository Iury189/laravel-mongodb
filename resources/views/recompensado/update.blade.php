@extends('templates.template_hunter')
@section('title', "Atualizar recompensa de {{ $nome }}")
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Atualizar recompensa de {{ $recompensado->hunter->nome_hunter }}
                            <a href="{{ url("rewarded") }}" class="btn btn-secondary float-end" title="Retornar listagem"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </h4>
                    </div>
                </div>
                <br>
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{ url("update-rewarded/$recompensado->_id") }}" method="POST">
                        {{ method_field('PATCH') }} {{ csrf_field() }}
                        <div class="form_group">
                            <div class="form_group">
                                <div for="recompensa_id">Recompensa:
                                    <select class="form-control @error('recompensa_id') is-invalid @enderror" name="recompensa_id">
                                        <option {{ $recompensado->recompensa_id == '' ? 'selected' : '' }} value="">{{ __('Escolha o Hunter') }}</option>
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
                                    <select class="form-control @error('hunter_id') is-invalid @enderror" name="hunter_id">
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
                                    <select class="form-control @error('concluida') is-invalid @enderror" name="concluida">
                                        <option {{ $recompensado->concluida == '' ? 'selected' : '' }} value="{{ $recompensado->concluida }}">Escolha uma opção</option>
                                        <option {{ $recompensado->concluida == true ? 'selected' : '' }} value="{{ $recompensado->concluida }}">Concluída</option>
                                    </select>
                                    @error('concluida')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" title="Atualizar"><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtenha o botão "Cadastrar"
            const update_botao = document.querySelector('button[type="submit"]');

            // Adicione um evento de clique ao botão
            update_botao.addEventListener('click', function(event) {
                event.preventDefault(); // Impede o envio do formulário

                // Chame a função confirmDelete() para exibir o modal
                confirmDelete('Atualizar recompensa', 'Deseja atualizar as informações dessa recompensa?');
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
