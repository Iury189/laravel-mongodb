@extends('templates.template_hunter')
@section('title', "Atualizar recompensa")
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Atualizar recompensa
                            <a href="{{ url("reward") }}" class="btn btn-secondary float-end" title="Retornar listagem"><i class="fa fa-arrow-left"></i>&nbsp;Retornar listagem</a>
                        </h4>
                    </div>
                </div>
                <br>
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{ url("update-reward/$recompensa->_id") }}" method="POST">
                        {{ method_field('PATCH') }} {{ csrf_field() }}
                        <div class="form_group">
                            <div class="form_group">
                                <div for="descricao_recompensa">Descrição:
                                    <input type="text" class="form-control @error('descricao_recompensa') is-invalid @enderror" name="descricao_recompensa" placeholder="Digite a descrição da recompensa" maxlength="50" value="{{ $recompensa->descricao_recompensa }}">
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
                                    <input type="text" class="form-control @error('valor_recompensa') is-invalid @enderror" name="valor_recompensa" placeholder="Digite o valor da recompensa" onkeypress="$(this).mask('0000000.00', {reverse: true});" value="{{ $recompensa->valor_recompensa }}">
                                    @error('valor_recompensa')
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
