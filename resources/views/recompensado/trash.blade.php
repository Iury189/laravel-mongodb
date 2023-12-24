@extends('templates.template_hunter')
@section('title', 'Lixeira de recompensados')
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Trash Recompensados
                            <a href="{{ url("rewarded") }}" class="btn btn-secondary float-end" title="Voltar"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-rewarded-trash') }}" method="GET" class="form-inline">
                        <div class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="Filtrar por descrição da recompensa ou Hunter">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></i>&nbsp;Filtrar</button>
                          </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Recompensa</th>
                                <th>Valor</th>
                                <th>Hunter recompensado</th>
                                <th>Status</th>
                                <th>Ação(ões)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recompensado as $r)
                                <tr>
                                    <td>{{ $r->recompensa->descricao_recompensa }}</td>
                                    <td>@dinheiro($r->recompensa->valor_recompensa)</td>
                                    <td>{{ $r->hunter->nome_hunter }}</td>
                                    <td> {{ $r->concluida == true ? 'Concluída' : 'Não concluída' }} </td>
                                    <td>
                                        <form action="{{ url("delete-register-rewarded/".$r->_id) }}" method="POST">
                                            <a href="{{ url("restore-register-rewarded/".$r->_id) }}" class="btn btn-primary"><i class="fa fa-arrows-rotate"></i>&nbsp;Restaurar</a>
                                            {{ ' ' }} {{ method_field('DELETE') }} {{ csrf_field() }}
                                            {{-- <button type="submit" class="btn btn-danger delete-button"><i class="fa fa-trash"></i>&nbsp;Deletar</button> --}}
                                        </form>
                                    </td>
                                </tr>
	                        @endforeach
                        </tbody>
                    </table>
                    {{ $recompensado->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Obtenha todos os botões de exclusão pela classe CSS
            const deleteButtons = document.querySelectorAll('.delete-button');

            // Adicione um evento de clique a cada botão de exclusão
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Impede o envio do formulário
                    confirmDelete('Excluir Recompensado', 'Deseja excluir permanentemente este recompensado?'); // Modal de confirmação
                });
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
