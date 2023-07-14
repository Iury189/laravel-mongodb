<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Jenssegers\Mongodb\Collection;

class TipoNenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = app('db')->getCollection('tipos_nen');

        $tipos_nens = [
            ['descricao' => 'Reforço'],
            ['descricao' => 'Emissão'],
            ['descricao' => 'Transformação'],
            ['descricao' => 'Manipulação'],
            ['descricao' => 'Materialização'],
            ['descricao' => 'Especialização'],
        ];

        $collection->insertMany($tipos_nens);
    }
}
