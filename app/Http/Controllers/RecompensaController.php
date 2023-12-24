<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecompensaRequest;
use App\Models\HunterModel;
use App\Models\RecompensaModel;
use App\Models\RecompensadoModel;
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
        $validacoes = $request->validated();

        $dados_tratados = [
            'descricao_recompensa' => trim((string) $validacoes['descricao_recompensa']),
            'valor_recompensa' => (double) $validacoes['valor_recompensa'],
        ];

        RecompensaModel::create($dados_tratados);
        Log::channel('daily')->notice("Recompensa $request->descricao_recompensa está presente no sistema.");
        return redirect('reward')->with('success_store',"Recompensa $request->descricao_recompensa está presente no sistema.");
    }

    public function show($id)
    {
        $recompensa = RecompensaModel::find($id);
        return view('recompensa.view', compact(['recompensa']));
    }

    public function edit($id)
    {
        $recompensa = RecompensaModel::find($id);
        return view('recompensa.update', compact(['recompensa']));
    }

    public function update(RecompensaRequest $request, $id)
    {
        $validacoes = $request->validated();

        $dados_tratados = [
            'descricao_recompensa' => trim((string) $validacoes['descricao_recompensa']),
            'valor_recompensa' => (double) $validacoes['valor_recompensa'],
        ];

        RecompensaModel::where('_id', $id)->update($dados_tratados);
        Log::channel('daily')->info("A recompensa $request->descricao_recompensa obteve atualizações em suas informações.");
        return redirect('reward')->with('success_update',"A recompensa $request->descricao_recompensa obteve atualizações em suas informações.");
    }

    public function destroy($id)
    {
        $descricao_recompensa = RecompensaModel::where('_id', '=', $id)->value('descricao_recompensa');
        RecompensaModel::where('_id', $id)->delete();
        Log::channel('daily')->warning("A recompensa $descricao_recompensa foi movida para a lixeira.");
        return redirect('reward')->with('success_trash',"A recompensa $descricao_recompensa foi movida para a lixeira.");
    }

    public function trashReward()
    {
        $recompensa = RecompensaModel::onlyTrashed()->paginate(5);
        return view('recompensa.trash', compact('recompensa'));
    }

    public function restoreRewardTrash($id)
    {
        $descricao_recompensa = RecompensaModel::onlyTrashed()->where('_id', '=', $id)->value('descricao_recompensa');
        $recompensa = RecompensaModel::onlyTrashed()->find($id);
        $recompensa->restore();
        Log::channel('daily')->notice("A recompensa $descricao_recompensa retornou a listagem de Hunters.");
        return redirect('reward')->with('success_restored',"A recompensa $descricao_recompensa retornou a listagem de recompensas.");
    }

    public function deleteRewardTrash($id)
    {
        $descricao_recompensa = RecompensaModel::onlyTrashed()->where('_id', '=', $id)->value('descricao_recompensa');
        $recompensa = RecompensaModel::onlyTrashed()->find($id);
        $quantidade_recompensas = RecompensadoModel::where('recompensa_id', $id)->count();
        if ($quantidade_recompensas > 0) {
            dd("Não é possível excluir essa recompensa permanentemente, pois essa recompensa está associado em $quantidade_recompensas registro(s) de recompensados.");
        }
        $recompensa->forceDelete();
        Log::channel('daily')->alert("A recompensa $descricao_recompensa foi excluída permanentemente do sistema.");
        return redirect('reward')->with('success_destroy',"A recompensa $descricao_recompensa foi excluída permanentemente do sistema.");
    }

    public function searchReward(Request $request)
    {
        $filtro = $request->input('search');
        $recompensa = RecompensaModel::where('descricao_recompensa', 'regex', "/$filtro/i")->paginate(5);
        return view('recompensa.reward', compact('recompensa'));
    }

    public function searchRewardTrash(Request $request)
    {
        $filtro = $request->input('search');
        $recompensa = RecompensaModel::onlyTrashed()->where('descricao_recompensa', 'regex', "/$filtro/i")->paginate(5);
        return view('recompensa.trash', compact('recompensa'));
    }
}
