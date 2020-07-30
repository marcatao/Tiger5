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
Route::get('/sobre-nos',  'SiteController@sobre_nos')->name('sobre-nos');
Route::get('/acao-social',  'SiteController@acao_social')->name('acao-social');
Route::get('/instagram',  'SiteController@instagram')->name('instagram');
Route::get('/aulas',  'SiteController@aulas')->name('aulas');

use App\aulas;
$a = aulas::all();
foreach($a as $aa){
  Route::get("/aulas/".$aa->link, 'SiteController@aula_detalhe')->name($aa->link);
}

Route::get('/contato',  'SiteController@contato')->name('contato');
Route::post('/contato',  'SiteController@contato_send')->name('contato');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

 


Route::get('/app', 'AdminController@index')->name('admin_index');
Route::get('/app/cadastro-aula',  'admin\aulasController@index')->name('cadastro-aula');
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

Route::get('/app/aluno',  'admin\AlunoController@index')->name('cadastro-alunos');  
Route::get('/app/table/{id}',  'admin\AlunoController@index_table')->name('table-alunos'); 

Route::get('/app/aluno/foto',  'admin\AlunoController@foto_form')->name('foto_form');
Route::post('/app/aluno/foto',  'admin\AlunoController@foto_form_save')->name('foto_form');
Route::get('/app/aluno/deleta',  'admin\AlunoController@deleta_form')->name('deleta_form');
Route::post('/app/aluno/deleta',  'admin\AlunoController@del')->name('deleta_form');
Route::post('/app/aluno/ativo',  'admin\AlunoController@change_status')->name('aluno-ativo');  
//Route::get('/app/aluno/{id}',  'admin\AlunoController@edita')->name('edicao-alunos');   
Route::get('/app/aluno/{id}',  'admin\AlunoController@aluno_detalhes')->name('edicao-alunos');  
Route::get('/app/aluno-form/{id}',  'admin\AlunoController@aluno_form')->name('aluno-form');  


Route::get('/app/aluno-plano/{id}',  'admin\PlanosController@aluno_plano')->name('aluno-plano');
Route::get('/app/post-plano',  'admin\PlanosController@post_plano')->name('post-plano');
Route::get('/app/plano/lista-aulas-aluno/{id}',  'admin\PlanosController@lista_aulas_aluno')->name('lista-aulas-aluno'); 

Route::get('/app/aluno/registra',  'admin\AlunoController@aluno_registra')->name('aluno-registra'); 
Route::post('/app/aluno/registra',  'admin\AlunoController@store_aluno_registra')->name('aluno-registra'); 

Route::get('/app/planos',  'admin\PlanosController@index')->name('cadastro-planos');   
Route::get('/app/planos/form/{id}',  'admin\PlanosController@form')->name('form-planos');
Route::post('/app/planos/form/{id}',  'admin\PlanosController@form_save')->name('form-planos');
Route::get('/app/planos/aulas-plano',  'admin\PlanosController@aulas_plano')->name('aulas-plano');
Route::post('/app/planos/aulas-plano',  'admin\PlanosController@aulas_plano_store')->name('aulas-plano');
Route::get('/app/planos/delete-aula-do-plano/{id}',  'admin\PlanosController@delete_aula_do_plano')->name('delete-aula-do-plano');
Route::post('/app/deleta-plano/{id}',  'admin\PlanosController@delete_plano')->name('deleta-plano');

Route::get('/app/login',  'admin\LoginController@index')->name('cadastro-login');   
Route::get('/app/login/create',  'admin\LoginController@create_form')->name('create-login');
Route::get('/app/login/edit/{id}',  'admin\LoginController@editarlogin')->name('edit-login');  
Route::post('/app/login/create',  'admin\LoginController@create')->name('create-login');

Route::get('/app/unidades',  'admin\UnidadeController@index')->name('unidade-lista');   
Route::get('/app/unidades-form/{id}',  'admin\UnidadeController@form')->name('unidade-form'); 
Route::post('/app/unidades-form/{id}',  'admin\UnidadeController@save')->name('unidade-save'); 
Route::get('/app/unidades-del/{id}',  'admin\UnidadeController@delete')->name('unidade-del'); 
 
Route::get('/app/forgot-password',  'admin\PassawordController@forgot_password')->name('forgot-password'); 
Route::post('/app/forgot-password',  'admin\PassawordController@forgot_password_send')->name('forgot-password');     

use App\User;
$p = User::where('remember_token','<>',null)->get();
foreach($p as $pp){
  Route::get("/forgot-password/".$pp->remember_token, 'admin\PassawordController@form_novasenha')->name($pp->remember_token);
}

Route::post('/app/password-update',  'admin\PassawordController@password_update')->name('password-update');  

