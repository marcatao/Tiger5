<?php

use Illuminate\Database\Seeder;

class profiles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     \App\profiles::create([
            'id'=> 0,
            'desc'=>'Administrador'
        ],
    );
 
    \App\profiles::create([
        'id'=> 2,
        'desc'=>'Professor'
    ],
);    
     \App\profiles::create([
            'id'=> 9,
            'desc'=>'Sem Acesso'
        ],
    );
    }
}
 