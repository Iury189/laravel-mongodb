<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Jenssegers\Mongodb\Collection;

class TipoSanguineoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = app('db')->getCollection('tipos_sanguineos');

        $tipos_sanguineos = [
            ['descricao' => 'A+'],
            ['descricao' => 'A-'],
            ['descricao' => 'B+'],
            ['descricao' => 'B-'],
            ['descricao' => 'AB+'],
            ['descricao' => 'AB-'],
            ['descricao' => 'O+'],
            ['descricao' => 'O-'],
        ];

        $collection->insertMany($tipos_sanguineos);
    }
}
