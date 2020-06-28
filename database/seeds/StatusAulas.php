<?php

use Illuminate\Database\Seeder;

class StatusAulas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\StatusAula::create([
            'id'=> 0,
            'desc'=>'Aula Agendada'
        ],
    );
     \App\StatusAula::create([
            'id'=> 1,
            'desc'=>'Aula confirmada'
        ],
    );
     \App\StatusAula::create([
            'id'=> 9,
            'desc'=>'Aula cancelada'
        ],
    );
    }
}
