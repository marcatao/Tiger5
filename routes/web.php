<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  'SiteController@index')->name('index');
Route::get('/home', 'AdminController@index')->name('admin_index');
Route::get('/sobre-nos',  'SiteController@sobre_nos')->name('sobre-nos');
Route::get('/acao-social',  'SiteController@acao_social')->name('acao-social');
Route::get('/instagram',  'SiteController@instagram')->name('instagram');
Route::get('/aulas',  'SiteController@aulas')->name('aulas');
Route::get("/parcerias/{id}", 'SiteController@parceria_detalhe')->name("parcerias_site");
Route::get('/parcerias-tigerthai',  'SiteController@acao_social')->name('acao-parcerias-site');
Route::get('/produtos-tigerthai',  'SiteController@produtos')->name('acao-produtos-site');
use App\aulas;
$a = aulas::all();
foreach($a as $aa){
  Route::get("/aulas/".$aa->link, 'SiteController@aula_detalhe')->name($aa->link);
}






Route::get('/contato',  'SiteController@contato')->name('contato');
Route::post('/contato',  'SiteController@contato_send')->name('contato');

Auth::routes();


Route::get('/check-planos','admin\CheckController@index')->name('check-planos');

Route::get('/app/parcerias', 'admin\ParceriasController@index')->name('parcerias-index');    
Route::get('/app/parceria-cadastro/{id}', 'admin\ParceriasController@parceria_cadastro')->name('parceria-cadastro');
Route::post('/app/parceria-cadastro/{id}', 'admin\ParceriasController@parceria_store')->name('parceria-cadastro');
Route::get('/app/parceria-delete/{id}', 'admin\ParceriasController@parceria_delete')->name('parceria-delete');

Route::get('/app/vitrine', 'admin\VitrineController@index')->name('vitrine');
Route::get('/app/vitrine-produto', 'admin\VitrineController@vitrine_form')->name('vitrine-produto');
Route::post('/app/vitrine-produto', 'admin\VitrineController@vitrine_save')->name('vitrine-produto');

Route::get('/app/vitrine-produto/{id}', 'admin\VitrineController@vitrine_edit')->name('vitrine-produto-edit');
Route::get('/app/vitrine-produto-delete/{id}', 'admin\VitrineController@vitrine_delete')->name('vitrine-produto-delete');
Route::get('/app/vitrine-produto-imagem', 'admin\VitrineController@vitrine_imagem_form')->name('vitrine-imagem-edit');
Route::post('/app/vitrine-produto-imagem', 'admin\VitrineController@vitrine_imagem_save')->name('vitrine-imagem-edit');
Route::get('/app/vitrine-produto-imagem-del/{id}', 'admin\VitrineController@vitrine_imagem_delete')->name('vitrine-imagem-delete');

Route::get('/app', 'AdminController@index')->name('admin_index');
Route::get('/app/cadastro-aula',  'admin\aulasController@index')->name('cadastro-aula');
Route::post('/app/cadastro-aula-ativa',  'admin\aulasController@cadastro_aula_ativa')->name('cadastro-aula-ativa');
Route::get('/app/form-aula/{id}', 'admin\aulasController@form_aulas')->name('form-aula');
Route::post('/app/form-aula/{id}','admin\aulasController@create_aulas')->name('create-form-aula');
Route::get('/app/deleta-aula/{id}',  'admin\aulasController@delete_aulas')->name('deleta-aula');
Route::get('/app/detalhe-aula/{id}',  'admin\aulasController@detalhe_aula')->name('detalhe-aula');
Route::post('/app/detalhe-aula/save',  'admin\aulasController@detalhe_aula_save')->name('detalhe-aula-save');

Route::get('/app/grade-aula',  'admin\aulasController@grade_aula')->name('grade-aula');
Route::get('/app/form-grade/{id}', 'admin\aulasController@form_grade')->name('form-grade');
Route::post('/app/form-grade/{id}','admin\aulasController@create_grade')->name('create-form-grade');
Route::post('/app/deleta-grade/{id}',  'admin\aulasController@delete_grade')->name('deleta-grade');


Route::get('/app/professor',  'admin\ProfessorController@index')->name('professor');
Route::get('/app/form-professor/{id}', 'admin\ProfessorController@form_professor')->name('form-professor');
Route::post('/app/form-professor/{id}','admin\ProfessorController@create_professor')->name('create-form-professor');
Route::get('/app/deleta-professor/{id}',  'admin\ProfessorController@delete_professor')->name('deleta-professor');
Route::get('/app/professor/foto',  'admin\ProfessorController@foto_form')->name('foto_form-professor');
Route::post('/app/professor/foto',  'admin\ProfessorController@foto_form_save')->name('foto_form-professor');
Route::get('/app/professor/form-unidade',  'admin\ProfessorController@form_unidade')->name('professor-form-unidade');
Route::post('/app/professor/form-unidade',  'admin\ProfessorController@form_unidade_save')->name('professor-form-unidade');
Route::get('/app/professor/form-unidade/{id}',  'admin\ProfessorController@delete_unidade')->name('professor-delete-unidade');
Route::get('/app/professor/form-aula',  'admin\ProfessorController@form_aula')->name('professor-form-aula');
Route::post('/app/professor/form-aula',  'admin\ProfessorController@form_aula_save')->name('professor-form-aula');
Route::get('/app/professor/form-aula/{id}',  'admin\ProfessorController@form_aula_delete')->name('professor-delete-aula');



Route::get('/app/aluno',  'admin\AlunoController@index')->name('cadastro-alunos');  
Route::get('/app/table/{id}',  'admin\AlunoController@index_table')->name('table-alunos'); 

Route::get('/app/aluno/foto',  'admin\AlunoController@foto_form')->name('foto_form');
Route::post('/app/aluno/foto',  'admin\AlunoController@foto_form_save')->name('foto_form');
Route::get('/app/aluno/deleta',  'admin\AlunoController@deleta_form')->name('deleta_form');
Route::post('/app/aluno/deleta',  'admin\AlunoController@del')->name('deleta_form');
Route::post('/app/aluno/ativo',  'admin\AlunoController@change_status')->name('aluno-ativo');  
//Route::get('/app/aluno/{id}',  'admin\AlunoController@edita')->name('edicao-alunos');  

Route::get('/app/form-plano-manual',  'admin\PlanosController@form_plano_manual')->name('form-plano-manual'); 
Route::get('/app/aluno/{id}',  'admin\AlunoController@aluno_detalhes')->name('edicao-alunos');  
Route::get('/app/aluno-form/{id}',  'admin\AlunoController@aluno_form')->name('aluno-form');  


Route::get('/app/aluno-plano/{id}',  'admin\PlanosController@aluno_plano')->name('aluno-plano'); 
Route::get('/app/post-plano',  'admin\PlanosController@post_plano')->name('post-plano');
Route::get('/app/plano/lista-aulas-aluno/{id}',  'admin\PlanosController@lista_aulas_aluno')->name('lista-aulas-aluno'); 

Route::get('/app/aluno/registra',  'admin\AlunoController@aluno_registra')->name('aluno-registra'); 
Route::post('/app/aluno/registra',  'admin\AlunoController@store_aluno_registra')->name('aluno-registra'); 

//Pagamento de planos
Route::get('/app/pagmanto-plano',  'admin\PlanosController@adicionar_pagamento')->name('pagmanto-plano');
Route::post('/app/pagmanto-plano',  'admin\PlanosController@salvar_pagamento')->name('salvar-plano');

Route::get('/app/adiciona-pagmanto-plano',  'admin\PlanosController@adiciona_pagmanto_plano_form')->name('adiciona-pagmanto-plano');
Route::post('/app/adiciona-pagmanto-plano',  'admin\PlanosController@adiciona_pagmanto_plano_save')->name('adiciona-pagmanto-plano');



Route::get('/app/planos',  'admin\PlanosController@index')->name('cadastro-planos');   
Route::get('/app/planos/form/{id}',  'admin\PlanosController@form')->name('form-planos');
Route::post('/app/planos/form/{id}',  'admin\PlanosController@form_save')->name('form-planos');
Route::get('/app/planos/aulas-plano',  'admin\PlanosController@aulas_plano')->name('aulas-plano');
Route::post('/app/planos/aulas-plano',  'admin\PlanosController@aulas_plano_store')->name('aulas-plano');
Route::get('/app/planos/delete-aula-do-plano/{id}',  'admin\PlanosController@delete_aula_do_plano')->name('delete-aula-do-plano');
Route::post('/app/deleta-plano/{id}',  'admin\PlanosController@delete_plano')->name('deleta-plano');
Route::get('/app/planos/lista-planos-aluno/{id}',  'admin\PlanosController@lista_planos_aluno')->name('lista-planos-aluno');

Route::get('/app/login',  'admin\LoginController@index')->name('cadastro-login');   
Route::get('/app/login/create',  'admin\LoginController@create_form')->name('create-login');
Route::get('/app/login/edit/{id}',  'admin\LoginController@editarlogin')->name('edit-login');  
Route::post('/app/login/create',  'admin\LoginController@create')->name('create-login');
Route::get('/app/login/historico-user',  'admin\LoginController@historico_user')->name('historico-user');



Route::get('/app/unidades',  'admin\UnidadeController@index')->name('unidade-lista');   
Route::get('/app/unidades-form/{id}',  'admin\UnidadeController@form')->name('unidade-form'); 
Route::post('/app/unidades-form/{id}',  'admin\UnidadeController@save')->name('unidade-save'); 
Route::get('/app/unidades-del/{id}',  'admin\UnidadeController@delete')->name('unidade-del'); 
 

Route::get('/app/lista-presenca',  'admin\ListaPresencaController@index')->name('chamada-index');   
Route::get('/app/lista-presenca/form-nova-chamada',  'admin\ListaPresencaController@form_nova_chamada')->name('form-nova-chamada');   

Route::get('/app/lista-presenca/aula-selection',  'admin\ListaPresencaController@aula_selection')->name('aula-selection');   
Route::get('/app/lista-presenca/professor-selection',  'admin\ListaPresencaController@professor_selection')->name('professor-selection');   
Route::post('/app/lista-presenca/save',  'admin\ListaPresencaController@presenca_save')->name('presenca-save');   
Route::get('/app/lista-presenca/listas',  'admin\ListaPresencaController@lista_presenca')->name('lista-presenca');   
Route::get('/app/lista-presenca/lista-presenca-alunos',  'admin\ListaPresencaController@lista_presenca_alunos')->name('lista-presenca-alunos');   
Route::post('/app/lista-presenca/chamada-aluno',  'admin\ListaPresencaController@chamada_aluno')->name('chamada-aluno');   
Route::delete('/app/lista-presenca/chamada-aluno',  'admin\ListaPresencaController@chamada_aluno_del')->name('chamada-aluno'); 
Route::post('/app/lista-presenca/altera-status',  'admin\ListaPresencaController@altera_status')->name('altera-status');   


Route::get('/app/forgot-password',  'admin\PassawordController@forgot_password')->name('forgot-password'); 
Route::post('/app/forgot-password',  'admin\PassawordController@forgot_password_send')->name('forgot-password');     



Route::get('/app/relatorios/faturas',  'admin\relatorios\FaturasController@faturas')->name('relatorios-faturas');   
Route::post('/app/relatorios/faturas',  'admin\relatorios\FaturasController@faturas_dados')->name('relatorios-faturas');   

Route::get('/app/relatorios/aniversarios',  'admin\relatorios\AniversariosController@aniversarios')->name('relatorios-aniversarios');   
Route::post('/app/relatorios/aniversarios',  'admin\relatorios\AniversariosController@aniversarios_dados')->name('relatorios-aniversarios');   


use App\User;
$p = User::where('remember_token','<>',null)->get();
foreach($p as $pp){
  Route::get("/forgot-password/".$pp->remember_token, 'admin\PassawordController@form_novasenha')->name($pp->remember_token);
}

Route::post('/app/password-update',  'admin\PassawordController@password_update')->name('password-update');  

