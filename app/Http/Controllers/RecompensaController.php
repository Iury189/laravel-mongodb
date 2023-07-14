<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecompensaRequest;
use App\Models\HunterModel;
use App\Models\RecompensaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecompensaController extends Controller
{

    public function index()
    {
        $recompensa = RecompensaModel::paginate(5);
        return view('recompensa.reward', compact('recompensa'));
    }

    public function create()
    {
        $hunter = HunterModel::select('_id','nome_hunter')->get();
        return view('recompensa.create', compact(['hunter']));
    }

    public function store(RecompensaRequest $request)
    {
        RecompensaModel::create(array_map('trim', $request->validated()));
        Log::channel('daily')->info("A recompensa está presente no sistema.");
        return redirect('reward')->with('success_store',"A recompensa está presente no sistema.");
    }

    public function show($id)
    {
        $recompensa = RecompensaModel::find($id);
        $hunter = HunterModel::select('_id','nome_hunter')->get();
        return view('recompensa.view', compact(['recompensa','hunter']));
    }

    public function edit($id)
    {
        $recompensa = RecompensaModel::find($id);
        $hunter = HunterModel::select('_id','nome_hunter')->get();
        return view('recompensa.update', compact(['recompensa','hunter']));
    }

    public function update(RecompensaRequest $request, $id)
    {
        RecompensaModel::where('_id', $id)->update(array_map('trim', $request->validated()));
        Log::channel('daily')->debug("Recompensa obteve atualizações em suas informações.");
        return redirect('reward')->with('success_update',"Recompensa obteve atualizações em suas informações.");
    }

    public function destroy($id)
    {
        RecompensaModel::where('_id', $id)->delete();
        Log::channel('daily')->warning("Recompensa foi movida para a lixeira.");
        return redirect('reward')->with('success_trash',"Recompensa foi movida para a lixeira.");
    }

    public function trashReward() // Página de registros excluídos
    {
        $recompensa = RecompensaModel::onlyTrashed()->paginate(5);
        return view('recompensa.trash', compact('recompensa'));
    }

    public function restoreRewardTrash($id) // Restaura registro da lixeira
    {
        $recompensa = RecompensaModel::onlyTrashed()->find($id);
        $recompensa->restore();
        Log::channel('daily')->notice("A recompensa retornou a listagem de Hunters.");
        return redirect('reward')->with('success_restored',"A recompensa retornou a listagem de recompensas.");
    }

    public function deleteRewardTrash($id) // Exclui registros da lixeira
    {
        $recompensa = RecompensaModel::onlyTrashed()->find($id);
        $recompensa->forceDelete();
        Log::channel('daily')->alert("A recompensa foi excluído(a) permanentemente do sistema.");
        return redirect('reward')->with('success_destroy',"A recompensa foi excluída permanentemente do sistema.");
    }

    public function searchReward(Request $request) // Filtra registro na página principal
    {
        $filtro = $request->input('search');
        $recompensa = RecompensaModel::where('descricao_recompensa', 'regex', "/$filtro/i")->paginate(5);
        return view('recompensa.reward', compact('recompensa'));
    }
}
