@extends('templates.template_hunter')
@section('title', 'Listar recompensados')
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Listar Recompensados
                            <a href="{{ url("trash-rewarded") }}" class="btn btn-danger float-center" title="Lixeira de recompensados"><i class="fa fa-dumpster"></i>&nbsp;Lixeira</a>
                            <a href="{{ url("/") }}" class="btn btn-info float-center" title="Hunters"><i class="fa fa-image-portrait"></i>&nbsp;Hunters</a>
                            <a href="{{ url("reward") }}" class="btn btn-dark float-center" title="Recompensas"><i class="fa fa-sack-dollar"></i>&nbsp;Recompensas</a>
                            <a href="{{ url("log-viewer") }}" class="btn btn-warning float-center" target="_blank" title="Registro de atividades"><i class="fa fa-circle-info"></i>&nbsp;Logs</a>
                            <a href="{{ url("create-rewarded") }}" class="btn btn-success float-end" title="Cadastrar"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
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
                                        <form action="{{ url("delete-rewarded/$r->_id") }}" method="POST">
                                            <a href="{{ url("view-rewarded/$r->_id") }}" class="btn btn-dark"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>
                                            {{-- <a href="{{ url("update-rewarded/$r->_id") }}" class="btn btn-primary" ><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a> --}}
                                            {{ ' ' }} {{ method_field('DELETE') }} {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Deletar</button>
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
    <!-- Footer -->
    <footer class="container">
        <div class="row">
            <div class="col text-center">
                <em> Iury Fernandes, {{ date('Y') }}.</em>
            </div>
        </div>
    </footer>
@endsection
