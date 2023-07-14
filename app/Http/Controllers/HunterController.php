<?php

namespace App\Http\Controllers;

use App\Http\Requests\HunterRequest;
use App\Models\HunterModel;
use App\Models\TipoHunterModel;
use App\Models\TipoNenModel;
use App\Models\TipoSanguineoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HunterController extends Controller
{
    public function index() // Página inicial
    {
        $hunter = HunterModel::paginate(5);
        return view('hunter.index', compact('hunter'));
    }

    public function create() // Formulário de cadastro
    {
        $tipo_hunter = TipoHunterModel::all();
        $tipo_nen = TipoNenModel::all();
        $tipo_sanguineo = TipoSanguineoModel::all();
        return view('hunter.create', compact(['tipo_hunter','tipo_nen','tipo_sanguineo']));
    }

    public function store(HunterRequest $request) // Cria o registro
    {
        HunterModel::create(array_map('trim', $request->validated()));
        Log::channel('daily')->info("Hunter $request->nome_hunter está presente no sistema.");
        return redirect('/')->with('success_store',"$request->nome_hunter está presente no sistema.");
    }

    public function show($id) // Apenas mostra o registro
    {
        $hunter = HunterModel::find($id);
        $tipo_hunter = TipoHunterModel::all();
        $tipo_nen = TipoNenModel::all();
        $tipo_sanguineo = TipoSanguineoModel::all();
        return view('hunter.view', compact(['hunter','tipo_hunter','tipo_nen','tipo_sanguineo']));
    }

    public function edit($id) // Formulário de atualização
    {
        $hunter = HunterModel::find($id);
        $tipo_hunter = TipoHunterModel::all();
        $tipo_nen = TipoNenModel::all();
        $tipo_sanguineo = TipoSanguineoModel::all();
        return view('hunter.update', compact(['hunter','tipo_hunter','tipo_nen','tipo_sanguineo']));
    }

    public function update(HunterRequest $request, $id) // Atualiza o registro
    {
        HunterModel::where('_id', $id)->update(array_map('trim', $request->validated()));
        Log::channel('daily')->debug("Hunter $request->nome_hunter obteve atualizações em suas informações.");
        return redirect('/')->with('success_update',"$request->nome_hunter obteve atualizações em suas informações.");
    }

    public function destroy($id) // Exclui o registro
    {
        $nome_hunter = HunterModel::where('_id', '=', $id)->value('nome_hunter');
        HunterModel::where('_id', $id)->delete();
        Log::channel('daily')->warning("Hunter $nome_hunter não está mais presente no sistema.");
        return redirect('/')->with('success_trash',"$nome_hunter não está mais presente no sistema.");
    }

    public function trashHunter() // Página de registros excluídos
    {
        $hunter = HunterModel::onlyTrashed()->paginate(5);
        return view('hunter.trash', compact('hunter'));
    }

    public function restoreHunterTrash($id) // Restaura registro da lixeira
    {
        $nome = HunterModel::onlyTrashed()->find($id)->nome_hunter;
        $hunter = HunterModel::onlyTrashed()->find($id);
        $hunter->restore();
        Log::channel('daily')->notice("Hunter $nome retornou a listagem de Hunters.");
        return redirect('/')->with('success_restored',"$nome retornou a listagem de Hunters.");
    }

    public function deleteHunterTrash($id) // Exclui registros da lixeira
    {
        $nome = HunterModel::onlyTrashed()->find($id)->nome_hunter;
        $hunter = HunterModel::onlyTrashed()->find($id);
        $hunter->forceDelete();
        Log::channel('daily')->alert("Hunter $nome foi excluído(a) permanentemente do sistema.");
        return redirect('/')->with('success_destroy',"$nome foi excluído(a) permanentemente do sistema.");
    }

    public function searchHunter(Request $request) // Filtra registro na página principal
    {
        $filtro = $request->input('search');
        $hunter = HunterModel::where('nome_hunter', 'regex', "/$filtro/i")->paginate(5);
        return view('hunter.index', compact('hunter'));
    }
}
