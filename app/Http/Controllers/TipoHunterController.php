<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoHunterRequest;
use App\Models\TipoHunterModel;
use Illuminate\Http\Request;

class TipoHunterController extends Controller
{
    public function index()
    {
        $tipos_hunter = TipoHunterModel::all();
        return response()->json($tipos_hunter, 200);
    }

    public function store(TipoHunterRequest $request)
    {
        $validacoes = $request->validated();

        $dados_tratados = [
            'descricao' => trim((string) $validacoes['descricao']),
        ];

        $tipo_hunter = TipoHunterModel::create($dados_tratados);

        return response()->json($tipo_hunter, 201);
    }

    public function show($id)
    {
        $tipo_hunter = TipoHunterModel::find($id);

        if (!$tipo_hunter) {
            return response()->json(['message' => 'Registro não encontrado para visualização.'], 404);
        }

        return response()->json($tipo_hunter, 200);
    }

    public function update(TipoHunterRequest $request, $id)
    {
        $tipo_hunter = TipoHunterModel::find($id);

        if (!$tipo_hunter) {
            return response()->json(['message' => 'Registro não encontrado para atualização.'], 404);
        }

        $validacoes = $request->validated();

        $dados_tratados = [
            'descricao' => trim((string) $validacoes['descricao']),
        ];

        TipoHunterModel::where('_id', $id)->update($dados_tratados);

        return response()->json($tipo_hunter, 201);
    }

    public function destroy($id)
    {
        $tipo_hunter = TipoHunterModel::find($id);

        if (!$tipo_hunter) {
            return response()->json(['message' => 'Registro não encontrado para exclusão.'], 404);
        }

        TipoHunterModel::where('_id', $id)->delete();
        return response()->json(['message' => 'Registro excluído.'], 201);
    }
}
