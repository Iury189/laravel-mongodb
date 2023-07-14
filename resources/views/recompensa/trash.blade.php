@extends('templates.template_hunter')
@section('title', 'Trash Rewards')
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Trash Rewards
                            <a href="{{ url("reward") }}" class="btn btn-secondary float-end" title="Voltar"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Ação(ões)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recompensa as $r)
                                <tr>
                                    <td>{{ $r->descricao_recompensa }}</td>
                                    <td>@dinheiro($r->valor_recompensa)</td>
                                    <td> {{ $r->concluida == true ? 'Concluída' : 'Não concluída' }} </td>
                                    <td>
                                        <form action="{{ url("delete-register-reward/".$r->_id) }}" method="POST">
                                            <a href="{{ url("restore-register-reward/".$r->_id) }}" class="btn btn-primary"><i class="fa fa-arrows-rotate"></i>&nbsp;Restaurar</a>
                                            {{ ' ' }} {{ method_field('DELETE') }} {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Deletar</button>
                                        </form>
                                    </td>
                                </tr>
	                        @endforeach
                        </tbody>
                    </table>
                    {{ $recompensa->links() }}
                </div>
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

                confirmDelete('Excluir recompensa', 'Deseja excluir permanentemente esta recompensa?'); // Modal de confirmação
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
