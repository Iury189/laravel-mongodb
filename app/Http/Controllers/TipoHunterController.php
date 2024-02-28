<?php

namespace App\Http\Controllers;

use App\Models\TipoHunterModel;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\TipoHunterRequest;
use Illuminate\Http\Request;

class TipoHunterController extends Controller
{
    public function index()
    {
        $tipos_hunter = TipoHunterModel::all();
        return response()->json($tipos_hunter, 200);
    }

    public function store(Request $request)
    {
        try {
            $validacoes = $request->validate([
                'descricao' => 'required|max:30',
            ]);
            $tipo_hunter = TipoHunterModel::create($validacoes);
            return response()->json($tipo_hunter, 201);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $tipo_hunter = TipoHunterModel::find($id);
        if (!$tipo_hunter) {
            return response()->json(['message' => 'Registro não encontrado para visualização.'], 404);
        }
        return response()->json($tipo_hunter, 200);
    }

    public function update(Request $request, $id)
    {
        try {
            $tipo_hunter = TipoHunterModel::find($id);
            if (!$tipo_hunter) {
                return response()->json(['message' => 'Registro não encontrado para atualização.'], 404);
            }
            $validacoes = $request->validate([
                'descricao' => 'required|max:30',
            ]);
            TipoHunterModel::where('_id', $id)->update($validacoes);
            $registro_atualizado = $tipo_hunter->find($id);
            return response()->json($registro_atualizado, 200);
        } catch (ValidationException $e) {
            return response()->json(['message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $tipo_hunter = TipoHunterModel::find($id);
        if (!$tipo_hunter) {
            return response()->json(['message' => 'Registro não encontrado para exclusão.'], 404);
        }
        TipoHunterModel::where('_id', $id)->delete();
        return response()->json(['message' => 'Registro excluído.'], 204);
    }
}
