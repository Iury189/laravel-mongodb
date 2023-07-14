@extends('templates.template_hunter')
@section('title', 'Listar Recompensas')
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Listar Recompensas
                            <a href="{{ url("trash-reward") }}" class="btn btn-danger float-center" title="Lixeira"><i class="fa fa-dumpster"></i>&nbsp;Lixeira</a>
                            <a href="{{ url("create-reward") }}" class="btn btn-success float-end" title="Cadastrar"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-reward') }}" method="GET" class="form-inline">
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
                                        <form action="{{ url("delete-reward/$r->_id") }}" method="POST">
                                            <a href="{{ url("view-reward/$r->_id") }}" class="btn btn-dark"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>
                                            <a href="{{ url("update-reward/$r->_id") }}" class="btn btn-primary" ><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a>
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
    <!-- Footer -->
    <footer class="container">
        <div class="row">
            <div class="col text-center">
                <em> Iury Fernandes, {{ date('Y') }}.</em>
            </div>
        </div>
    </footer>
@endsection
