@extends('templates.template_hunter')
@section('title', 'Listar Hunters')
@section('content')
    <div class="contained">
        <div class="row">
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <h4>Listar Hunters
                            <a href="{{ url("trash-hunter") }}" class="btn btn-danger float-center" title="Lixeira"><i class="fa fa-dumpster"></i>&nbsp;Lixeira</a>
                            <a href="{{ url("log-viewer") }}" class="btn btn-warning float-center" target="_blank" title="LogViewer"><i class="fa fa-circle-info"></i>&nbsp;Logs</a>
                            <a href="{{ url("create-hunter") }}" class="btn btn-success float-end" title="Cadastrar"><i class="fa fa-plus"></i>&nbsp;Cadastrar</a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('search-hunter') }}" method="GET" class="form-inline">
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
                                <th title="Início">Início</th>
                                <th title="Término">Término</th>
                                <th title="Ação(ões)">Ação(ões)</th>
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
                                    <td title="{{ \Carbon\Carbon::parse($hxh->inicio)->format('d/m/Y') }}">{{ \Carbon\Carbon::parse($hxh->inicio)->format('d/m/Y') }}</td>
                                    <td title="{{ \Carbon\Carbon::parse($hxh->termino)->format('d/m/Y') }}">{{ \Carbon\Carbon::parse($hxh->termino)->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ url("delete-hunter/$hxh->_id") }}" method="POST">
                                            <a href="{{ url("view-hunter/$hxh->_id") }}" class="btn btn-dark" title="Visualizar {{ $hxh->nome_hunter }}"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>
                                            <a href="{{ url("update-hunter/$hxh->_id") }}" class="btn btn-primary" title="Atualizar {{ $hxh->nome_hunter }}"><i class="fa fa-arrows-rotate"></i>&nbsp;Atualizar</a>
                                            {{ ' ' }} {{ method_field('DELETE') }} {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger" title="Deletar {{ $hxh->nome_hunter }}"><i class="fa fa-trash"></i>&nbsp;Deletar</button>
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
    <!-- Footer -->
    <footer class="container">
        <div class="row">
            <div class="col text-center">
                <em> Iury Fernandes, {{ date('Y') }}.</em>
            </div>
        </div>
    </footer>
@endsection
