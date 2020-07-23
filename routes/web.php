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


Route::get('/app/professor',  'admin\professorController@index')->name('professor');
Route::get('/app/form-professor/{id}', 'admin\professorController@form_professor')->name('form-professor');
Route::post('/app/form-professor/{id}','admin\professorController@create_professor')->name('create-form-professor');
Route::get('/app/deleta-professor/{id}',  'admin\professorController@delete_professor')->name('deleta-professor');

Route::get('/app/aluno',  'admin\AlunoController@index')->name('cadastro-alunos');   
Route::get('/app/aluno/{id}',  'admin\AlunoController@edita')->name('edicao-alunos');   
Route::get('/app/aluno/registra',  'admin\AlunoController@aluno_registra')->name('aluno-registra'); 
Route::post('/app/aluno/registra',  'admin\AlunoController@store_aluno_registra')->name('aluno-registra'); 

Route::get('/app/login',  'admin\LoginController@index')->name('cadastro-login');   
Route::get('/app/login/create',  'admin\LoginController@create_form')->name('create-login'); 
Route::post('/app/login/create',  'admin\LoginController@create')->name('create-login');

Route::get('/app/forgot-password',  'admin\PassawordController@forgot_password')->name('forgot-password'); 
Route::post('/app/forgot-password',  'admin\PassawordController@forgot_password_send')->name('forgot-password');     

use App\User;
$p = User::where('remember_token','<>',null)->get();
foreach($p as $pp){
  Route::get("/forgot-password/".$pp->remember_token, 'admin\PassawordController@form_novasenha')->name($pp->remember_token);
}

Route::post('/app/password-update',  'admin\PassawordController@password_update')->name('password-update');  

