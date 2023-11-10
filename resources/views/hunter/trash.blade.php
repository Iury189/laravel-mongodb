@extends('templates.template_hunter')
@section('title', 'Lixeira de Hunters')
@section('content')
    <!-- Form -->
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Lixeira de Hunters
                        <a href="{{ url("/") }}" class="btn btn-secondary float-end" title="Voltar"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-hunter-trash') }}" method="GET" class="form-inline">
                        <div class="input-group">
                          <input type="text" name="search" class="form-control" placeholder="Filtrar por nome">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-magnifying-glass"></i></i>&nbsp;Filtrar</button>
                          </div>
                        </div>
                    </form>
                    <table class="table">
                        <thead>
                            <tr>
                                <th title="Nome">Nome</th>
                                <th title="Idade">Idade</th>
                                <th title="Altura">Altura</th>
                                <th title="Peso">Peso</th>
                                <th title="Tipo de hunter">Tipo de Hunter</th>
                                <th title="Tipo de nen">Tipo de Nen</th>
                                <th title="Tipo sanguíneo">Tipo sanguíneo</th>
                                <th title="Ações">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hunter as $hxh)
                                <tr>
                                    <td>{{ $hxh->nome_hunter }}</td>
                                    <td>{{ $hxh->idade_hunter }}</td>
                                    <td>@peso($hxh->peso_hunter)</td>
                                    <td>@altura($hxh->altura_hunter)</td>
                                    <td>{{ $hxh->tipo_hunter_id == $hxh->tipos_hunter->_id ? $hxh->tipos_hunter->descricao : '' }}</td>
                                    <td>{{ $hxh->tipo_nen_id == $hxh->tipos_nen->_id ? $hxh->tipos_nen->descricao : '' }}</td>
                                    <td>{{ $hxh->tipo_sangue_id == $hxh->tipos_sanguineos->_id ? $hxh->tipos_sanguineos->descricao : '' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($hxh->deleted_at)->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <form action="{{ url("delete-register-hunter/".$hxh->_id) }}" method="POST">
                                            <a href="{{ url("restore-register-hunter/".$hxh->_id) }}" class="btn btn-primary" title="Restaurar {{ $hxh->nome_hunter }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Restaurar</a>
                                            {{ ' ' }} {{ method_field('DELETE') }} {{ csrf_field() }}
                                            {{-- <button type="submit" class="btn btn-danger delete-button" title="Deletar {{ $hxh->nome_hunter }}"><i class="fa fa-trash"></i>&nbsp;Deletar</button> --}}
                                        </form>
                                    </td>
                                </tr>
	                        @endforeach
                        </tbody>
                    </table>
                    {{ $hunter->links() }}
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
                    confirmDelete('Excluir Hunter', 'Deseja excluir permanentemente este Hunter?'); // Modal de confirmação
                });
            });

            function confirmDelete(title, text, id) {
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
