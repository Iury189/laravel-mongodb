<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecompensadoRequest;
use App\Models\{HunterModel,RecompensaModel,RecompensadoModel};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecompensadoController extends Controller
{
    public function index()
    {
        $recompensado = RecompensadoModel::paginate(5);
        return view('recompensado.rewarded', compact(['recompensado']));
    }

    public function create()
    {
        $hunter = HunterModel::select('_id','nome_hunter')->get();
        $recompensas_selecionadas = RecompensadoModel::pluck('recompensa_id')->all();
        $recompensa = RecompensaModel::whereNotIn('_id', $recompensas_selecionadas)->select('_id', 'descricao_recompensa')->get();
        return view('recompensado.create', compact(['hunter','recompensa']));
    }

    public function store(RecompensadoRequest $request)
    {
        $validacoes = $request->validated();
        $nome = HunterModel::where('_id', '=', $request->hunter_id)->value('nome_hunter');
        $dados_tratados = [
            'recompensa_id' => trim((string) $validacoes['recompensa_id']),
            'hunter_id' => trim((string) $validacoes['hunter_id']),
            'concluida' => (boolean) $validacoes['concluida'],
        ];
        RecompensadoModel::create($dados_tratados);
        Log::channel('daily')->notice("Recompensado $nome está presente no sistema.");
        return to_route('indexRewarded')->with('success_store',"Recompensado $nome está presente no sistema.");
    }

    public function show($id)
    {
        $recompensado = RecompensadoModel::find($id);
        $hunter = HunterModel::select('_id','nome_hunter')->get();
        $recompensas_selecionadas = RecompensadoModel::pluck('recompensa_id')->all();
        $recompensa = RecompensaModel::whereNotIn('_id', $recompensas_selecionadas)->select('_id', 'descricao_recompensa')->get();
        $nome = HunterModel::where('id', '=', $id)->value('nome_hunter');
        return view('recompensado.view', compact(['recompensado','recompensa','hunter','nome']));
    }

    public function edit($id)
    {
        $recompensado = RecompensadoModel::find($id);
        $hunter = HunterModel::select('_id','nome_hunter')->get();
        $recompensas_selecionadas = RecompensadoModel::pluck('recompensa_id')->all();
        $recompensa = RecompensaModel::whereNotIn('_id', $recompensas_selecionadas)->select('_id', 'descricao_recompensa')->get();
        $nome = HunterModel::where('id', '=', $id)->value('nome_hunter');
        return view('recompensado.update', compact(['recompensado','recompensa','hunter','nome']));
    }

    public function update(RecompensadoRequest $request, $id)
    {
        $validacoes = $request->validated();
        $nome = HunterModel::where('_id', '=', $request->hunter_id)->value('nome_hunter');
        $dados_tratados = [
            'recompensa_id' => trim((string) $validacoes['recompensa_id']),
            'hunter_id' => trim((string) $validacoes['hunter_id']),
            'concluida' => (boolean) $validacoes['concluida'],
        ];
        RecompensadoModel::where('_id', $id)->update($dados_tratados);
        Log::channel('daily')->info("A recompensa de $nome obteve atualizações em suas informações.");
        return to_route('indexRewarded')->with('success_update',"A recompensa de $nome obteve atualizações em suas informações.");
    }

    public function destroy($id)
    {
        $id_recompensado = RecompensadoModel::where('_id', '=', $id)->value('hunter_id');
        $nome = HunterModel::where('_id', '=', $id_recompensado)->value('nome_hunter');
        RecompensadoModel::where('_id', $id)->delete();
        Log::channel('daily')->warning("Recompensado $nome foi movido para a lixeira.");
        return to_route('indexRewarded')->with('success_trash',"Recompensado $nome foi movido para a lixeira.");
    }

    public function trashRewarded()
    {
        $recompensado = RecompensadoModel::onlyTrashed()->paginate(5);
        return view('recompensado.trash', compact('recompensado'));
    }

    public function restoreRewardedTrash($id)
    {
        $id_recompensado = RecompensadoModel::onlyTrashed()->where('_id', '=', $id)->value('hunter_id');
        $nome = HunterModel::where('_id', '=', $id_recompensado)->value('nome_hunter');
        $recompensado = RecompensadoModel::onlyTrashed()->find($id);
        $recompensado->restore();
        Log::channel('daily')->notice("Recompensado $nome retornou a listagem de Hunters.");
        return to_route('trashRewarded')->with('success_restored',"Recompensado $nome retornou a listagem de recompensas.");
    }

    public function deleteRewardedTrash($id)
    {
        $id_recompensado = RecompensadoModel::onlyTrashed()->where('_id', '=', $id)->value('hunter_id');
        $nome = HunterModel::where('_id', '=', $id_recompensado)->value('nome_hunter');
        $recompensado = RecompensadoModel::onlyTrashed()->find($id);
        $recompensado->forceDelete();
        Log::channel('daily')->alert("Recompensado $nome foi excluído permanentemente do sistema.");
        return to_route('trashRewarded')->with('success_destroy',"Recompensado $nome foi excluído permanentemente do sistema.");
    }

    public function searchRewarded(Request $request)
    {
        $filtro = $request->input('search');
        $recompensado = RecompensadoModel::raw(function($collection) use ($filtro) {
            return $collection->aggregate([
                [
                    '$lookup' => [
                        'from' => 'hunters',
                        'localField' => 'hunter_id',
                        'foreignField' => '_id',
                        'as' => 'hunter'
                    ]
                ],
                ['$unwind' => '$hunter'],
                [
                    '$lookup' => [
                        'from' => 'recompensas',
                        'localField' => 'recompensa_id',
                        'foreignField' => '_id',
                        'as' => 'recompensa'
                    ]
                ],
                ['$unwind' => '$recompensa'],
                [
                    '$match' => [
                        '$or' => [
                            ['hunter.nome_hunter' => ['$regex' => $filtro, '$options' => 'i']],
                            ['recompensa.descricao_recompensa' => ['$regex' => $filtro, '$options' => 'i']]
                        ]
                    ]
                ],
                [
                    '$project' => [
                        '_id' => '$_id',
                        'nome_hunter' => '$hunter.nome_hunter',
                        'descricao_recompensa' => '$recompensa.descricao_recompensa',
                        'valor_recompensa' => '$recompensa.valor_recompensa',
                        'concluida' => '$concluida',
                    ]
                ],
                ['$limit' => 5]
            ]);
        });
        dd($recompensado);
        return view('recompensado.rewarded', compact('recompensado'));
    }

    public function searchRewardedTrash(Request $request)
    {
        $filtro = $request->input('search');
        $recompensado = RecompensadoModel::raw(function ($collection) use ($filtro) {
            return $collection->aggregate([
                [
                    '$lookup' => [
                        'from' => 'hunters',
                        'localField' => '_id',
                        'foreignField' => 'hunter_id',
                        'as' => 'hunter'
                    ]
                ],
                ['$unwind' => '$hunter'],
                [
                    '$lookup' => [
                        'from' => 'recompensas',
                        'localField' => '_id',
                        'foreignField' => 'recompensa_id',
                        'as' => 'recompensa'
                    ]
                ],
                [
                    '$match' => [
                        '$or' => [
                            ['hunter.nome_hunter' => ['$regex' => $filtro, '$options' => 'i']],
                            ['recompensa.descricao_recompensa' => ['$regex' => $filtro, '$options' => 'i']]
                        ]
                    ]
                ],
                [
                    '$project' => [
                        '_id' => '_id',
                        'nome_hunter' => '$hunter.nome_hunter',
                        'descricao_recompensa' => '$recompensa.descricao_recompensa',
                        'valor_recompensa' => '$recompensa.valor_recompensa',
                        'concluida' => 'concluida',
                    ]
                ],
                [
                    '$limit' => 5
                ],
                [
                    '$match' => [
                        'deleted_at' => ['$exists' => true]
                    ]
                ]
            ]);
        });
        dd($recompensado);
        return view('recompensado.trash', compact('recompensado'));
    }
}
