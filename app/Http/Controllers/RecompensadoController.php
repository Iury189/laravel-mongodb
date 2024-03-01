<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecompensadoRequest;
use App\Models\{HunterModel,RecompensaModel,RecompensadoModel};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;

class RecompensadoController extends Controller
{
    public function index()
    {
        $query = RecompensadoModel::raw(function($collection) {
            return $collection->aggregate([
                [
                    '$addFields' => [
                        'recompensa_id' => ['$toObjectId' => '$recompensa_id'],
                        'hunter_id' => ['$toObjectId' => '$hunter_id']
                    ]
                ],
                [
                    '$lookup' => [
                        'from' => 'hunters',
                        'localField' => 'hunter_id',
                        'foreignField' => '_id',
                        'as' => 'hunters'
                    ]
                ],
                [
                    '$unwind' => '$hunters'
                ],
                [
                    '$lookup' => [
                        'from' => 'recompensas',
                        'localField' => 'recompensa_id',
                        'foreignField' => '_id',
                        'as' => 'recompensas'
                    ]
                ],
                [
                    '$unwind' => '$recompensas'
                ],
                [
                    '$match' => [
                        'deleted_at' => null
                    ]
                ],
                [
                    '$project' => [
                        '_id' => 1,
                        'descricao_recompensa' => '$recompensas.descricao_recompensa',
                        'valor_recompensa' => '$recompensas.valor_recompensa',
                        'nome_hunter' => '$hunters.nome_hunter',
                        'concluida' => 1,
                    ]
                ],
            ]);
        });
        $page = Paginator::resolveCurrentPage() ?: 1;
        $registros_pagina = 5;
        $items = $query->skip(($page - 1) * $registros_pagina)->take($registros_pagina)->toArray();
        $recompensado = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $query->count(),
            $registros_pagina,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
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
        $query = RecompensadoModel::raw(function($collection) {
            return $collection->aggregate([
                [
                    '$addFields' => [
                        'recompensa_id' => ['$toObjectId' => '$recompensa_id'],
                        'hunter_id' => ['$toObjectId' => '$hunter_id']
                    ]
                ],
                [
                    '$lookup' => [
                        'from' => 'hunters',
                        'localField' => 'hunter_id',
                        'foreignField' => '_id',
                        'as' => 'hunters'
                    ]
                ],
                [
                    '$unwind' => '$hunters'
                ],
                [
                    '$lookup' => [
                        'from' => 'recompensas',
                        'localField' => 'recompensa_id',
                        'foreignField' => '_id',
                        'as' => 'recompensas'
                    ]
                ],
                [
                    '$unwind' => '$recompensas'
                ],
                [
                    '$match' => [
                        'deleted_at' => ['$exists' => true, '$ne' => null]
                    ]
                ],
                [
                    '$project' => [
                        '_id' => 1,
                        'descricao_recompensa' => '$recompensas.descricao_recompensa',
                        'valor_recompensa' => '$recompensas.valor_recompensa',
                        'nome_hunter' => '$hunters.nome_hunter',
                        'concluida' => 1,
                    ]
                ],
            ]);
        });
        $page = Paginator::resolveCurrentPage() ?: 1;
        $registros_pagina = 5;
        $items = $query->skip(($page - 1) * $registros_pagina)->take($registros_pagina)->toArray();
        $recompensado = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $query->count(),
            $registros_pagina,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
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
        $query = RecompensadoModel::raw(function($collection) use ($filtro) {
            return $collection->aggregate([
                [
                    '$addFields' => [
                        'recompensa_id' => ['$toObjectId' => '$recompensa_id'],
                        'hunter_id' => ['$toObjectId' => '$hunter_id']
                    ]
                ],
                [
                    '$lookup' => [
                        'from' => 'hunters',
                        'localField' => 'hunter_id',
                        'foreignField' => '_id',
                        'as' => 'hunters'
                    ]
                ],
                [
                    '$unwind' => '$hunters'
                ],
                [
                    '$lookup' => [
                        'from' => 'recompensas',
                        'localField' => 'recompensa_id',
                        'foreignField' => '_id',
                        'as' => 'recompensas'
                    ]
                ],
                [
                    '$unwind' => '$recompensas'
                ],
                [
                    '$match' => [
                        '$or' => [
                            ['recompensas.descricao_recompensa' => ['$regex' => $filtro, '$options' => 'i']],
                            ['hunters.nome_hunter' => ['$regex' => $filtro, '$options' => 'i']]
                        ]
                    ]
                ],
                [
                    '$project' => [
                        '_id' => 1,
                        'descricao_recompensa' => '$recompensas.descricao_recompensa',
                        'valor_recompensa' => '$recompensas.valor_recompensa',
                        'nome_hunter' => '$hunters.nome_hunter',
                        'concluida' => 1,
                    ]
                ],
                [
                    '$limit' => 5
                ],
            ]);
        });
        $page = Paginator::resolveCurrentPage() ?: 1;
        $registros_pagina = 5;
        $items = $query->skip(($page - 1) * $registros_pagina)->take($registros_pagina)->toArray();
        $recompensado = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $query->count(),
            $registros_pagina,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
        return view('recompensado.rewarded', compact('recompensado'));
    }

    public function searchRewardedTrash(Request $request)
    {
        $filtro = $request->input('search');
        $query = RecompensadoModel::raw(function ($collection) use ($filtro) {
            return $collection->aggregate([
                [
                    '$addFields' => [
                        'recompensa_id' => ['$toObjectId' => '$recompensa_id'],
                        'hunter_id' => ['$toObjectId' => '$hunter_id']
                    ]
                ],
                [
                    '$lookup' => [
                        'from' => 'hunters',
                        'localField' => 'hunter_id',
                        'foreignField' => '_id',
                        'as' => 'hunters'
                    ]
                ],
                [
                    '$unwind' => '$hunters'
                ],
                [
                    '$lookup' => [
                        'from' => 'recompensas',
                        'localField' => 'recompensa_id',
                        'foreignField' => '_id',
                        'as' => 'recompensas'
                    ]
                ],
                [
                    '$unwind' => '$recompensas'
                ],
                [
                    '$match' => [
                        '$or' => [
                            ['recompensas.descricao_recompensa' => ['$regex' => $filtro, '$options' => 'i']],
                            ['hunters.nome_hunter' => ['$regex' => $filtro, '$options' => 'i']]
                        ],
                        'deleted_at' => ['$exists' => true]
                    ]
                ],
                [
                    '$project' => [
                        '_id' => 1,
                        'descricao_recompensa' => '$recompensas.descricao_recompensa',
                        'valor_recompensa' => '$recompensas.valor_recompensa',
                        'nome_hunter' => '$hunters.nome_hunter',
                        'concluida' => 1,
                    ]
                ],
                [
                    '$limit' => 5
                ],
            ]);
        });
        $page = Paginator::resolveCurrentPage() ?: 1;
        $registros_pagina = 5;
        $items = $query->skip(($page - 1) * $registros_pagina)->take($registros_pagina)->toArray();
        $recompensado = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $query->count(),
            $registros_pagina,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
        return view('recompensado.trash', compact('recompensado'));
    }
}
