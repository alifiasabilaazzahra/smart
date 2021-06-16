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

Route::get('/', function () {
    return redirect('/home');
});

// Route::get('/temp_admin', function ()
// {
//     $data['title']="Admin";
//     $data['load']=[];
//     return view('temp/temp_admin', $data);
// });

Route::get('/temp_admin', 'AdminController@index');

Route::get('/temp_guru', function ()
{
    $data['title']="Guru";
    $data['load']=[];
    return view('temp/temp_guru', $data);
});

Route::get('/temp_siswa', function ()
{
    $data['title']="Siswa";
    $data['load']=[];
    return view('temp/temp_siswa', $data);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/sign_in', 'AutentikasiController@login');

Route::group(['prefix' => 'siswa'], function () {
    Route::get('/', 'StudentController@index');
});

Route::group(['prefix' => 'guru'], function () {
    Route::get('/', 'TeacherController@index');
    Route::get('/buat_tugas', 'TeacherController@buat_tugas');
    Route::get('/list_tugas', 'TeacherController@list_tugas');
    Route::get('/tinjau_tugas/{id_tugas}', 'TeacherController@tinjau_tugas');
    Route::get('/soal/{id_tugas}', 'TeacherController@lihat_soal');
    Route::get('/data_kelas/{id_tugas}', 'TeacherController@data_kelas');
    Route::get('/tinjau_nilai/{id_tugas}', 'TeacherController@tinjau_nilai');
    Route::get('/info_tugas/{id_tugas}', 'TeacherController@update_info_tugas');
    Route::get('/update_soal/{id_tugas}/{id_pertanyaan}', 'TeacherController@update_soal');
    Route::get('/tinjau_nilai_kelas/{id_tugas}/{id_kelas}', 'TeacherController@tinjau_nilai_kelas');
    Route::get('/ekspor_excell/{id_tugas}/{id_kelas}','TeacherController@ekspor_excell');
    Route::get('/send_email/{id_tugas}/{id_kelas}', 'TeacherController@send_email');
    Route::get('/materi', 'TeacherController@theory');
    Route::get('/tambah_materi', 'TeacherController@tambah_theory');
    Route::get('/update_materi/{id}', 'TeacherController@edit_theory');
    Route::get('/assign-kelas/{id}','TeacherController@kelas_theory');
    Route::get('/ikuti-jadwal/{id}','TeacherController@ikuti_jadwal');

    Route::post('/tbhpertanyaan', 'TeacherController@buat_soal');    
    Route::post('/tugas', 'TeacherController@in_tugas');
    Route::post('/pertanyaan', 'TeacherController@in_pertanyaan');
    Route::post('/kelas', 'TeacherController@in_kelas');
    Route::post('/materi', 'TeacherController@insert_theory');
    Route::post('/materi/kelas', 'TeacherController@in_kelas_theory');

    Route::delete('/kelas/{id}', 'TeacherController@del_kelas');
    Route::delete('/tugas/{id}', 'TeacherController@del_tugas');
    Route::delete('/materi', 'TeacherController@delete_theory');
    Route::delete('/materi/kelas/{id}', 'TeacherController@del_kelas_theory');

    Route::put('/info_tugas','TeacherController@up_info_tugas');
    Route::put('/soal','TeacherController@up_soal');
    Route::put('/materi', 'TeacherController@update_theory');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('/kategori_tugas', 'AdminController@kategori_tugas');
    Route::get('/mata_pelajaran', 'AdminController@mata_pelajaran');
    Route::get('/kelas', 'AdminController@kelas');
    Route::get('/siswa', ['as' => 'siswa', 'uses' => 'AdminController@siswa']);
    Route::get('/guru', 'AdminController@guru');
    Route::get('/assign-mapel/{id}','AdminController@mapel_guru');
    Route::get('/jadwal', 'AdminController@jadwal');

    Route::get('/tambah_kategori_tugas', 'AdminController@tambah_kategori_tugas');
    Route::get('/tambah_mata_pelajaran', 'AdminController@tambah_mata_pelajaran');
    Route::get('/tambah_kelas', 'AdminController@tambah_kelas');
    Route::get('/tambah_siswa', 'AdminController@tambah_siswa');
    Route::get('/tambah_guru', 'AdminController@tambah_guru');
    Route::get('/tambah_jadwal', 'AdminController@tambah_jadwal');

    Route::get('/update_kategori_tugas/{id}', 'AdminController@perbarui_kategori_tugas');
    Route::get('/update_mata_pelajaran/{id}', 'AdminController@perbarui_mata_pelajaran');
    Route::get('/update_kelas/{id}', 'AdminController@perbarui_kelas');
    Route::get('/update_siswa/{id}', 'AdminController@perbarui_siswa');
    Route::get('/update_guru/{id}', 'AdminController@perbarui_guru');
    Route::get('/update_jadwal/{id}', 'AdminController@perbarui_jadwal');

    Route::post('/kategori_tugas', 'AdminController@insert_kategori_tugas');
    Route::post('/mata_pelajaran', 'AdminController@insert_mata_pelajaran');
    Route::post('/kelas', 'AdminController@insert_kelas');
    Route::post('/siswa', 'AdminController@insert_siswa');
    Route::post('/guru', 'AdminController@insert_guru');
    Route::post('/guru/mapel', 'AdminController@in_mapel_guru');
    Route::post('/jadwal', 'AdminController@insert_jadwal');

    Route::put('/kategori_tugas', 'AdminController@update_kategori_tugas');
    Route::put('/mata_pelajaran', 'AdminController@update_mata_pelajaran');
    Route::put('/kelas', 'AdminController@update_kelas');
    Route::put('/siswa', 'AdminController@update_siswa');
    Route::put('/guru', 'AdminController@update_guru');
    Route::put('/jadwal', 'AdminController@update_jadwal');

    Route::delete('/kategori_tugas', 'AdminController@delete_kategori_tugas');
    Route::delete('/mata_pelajaran', 'AdminController@delete_mata_pelajaran');
    Route::delete('/kelas', 'AdminController@delete_kelas');
    Route::delete('/siswa', 'AdminController@delete_siswa');
    Route::delete('/guru', 'AdminController@delete_guru');
    Route::delete('/guru/mapel/{id}', 'AdminController@del_mapel_guru');
    Route::delete('/jadwal', 'AdminController@delete_jadwal');

});


Route::group(['prefix' => 'student'], function ()
{
    Route::get('/', 'StudentController@index');
    Route::get('/pengerjaan/{id}', 'StudentController@pengerjaan');
    Route::get('/list_nilai', 'StudentController@nilai_tugas');
    Route::get('/materi/{id}', 'StudentController@theory');
    Route::post('/pengerjaan','StudentController@in_jawaban');
    Route::get('/ikuti-jadwal/{id}','StudentController@ikuti_jadwal');

});


