<?php

// Route untuk test database
Route::get('sampledata', function () {
    DB::table('siswa')->insert([
        [
            'nisn' => '1001',
            'nama_siswa' => 'Ghina Qatrunada',
            'tanggal_lahir' => '1990-02-12',
            'jenis_kelamin' => 'P',
            'created_at' => '2016-03-10 19:10:15',
            'updated_at' => '2016-03-10 19:10:15'
        ],
        [
            'nisn' => '1002',
            'nama_siswa' => 'Abdul Malik',
            'tanggal_lahir' => '1991-02-13',
            'jenis_kelamin' => 'L',
            'created_at' => '2016-03-10 19:10:15',
            'updated_at' => '2016-03-10 19:10:15'
        ],
        [
            'nisn' => '1003',
            'nama_siswa' => 'Rofiya Dienulhaq',
            'tanggal_lahir' => '1992-04-24',
            'jenis_kelamin' => 'P',
            'created_at' => '2016-03-10 19:10:15',
            'updated_at' => '2016-03-10 19:10:15'
        ],
    ]);
}); 

// Route controller rahasia
Route::get('halaman-rahasia', [
    'as' => 'secret',
    'uses' => 'RahasiaController@halamanRahasia'
]);

Route::get('showmesecret', 'RahasiaController@showMeSecret');

// Route controller halaman statis
Route::get('/', 'PagesController@homepage');
Route::get('about', 'PagesController@about');

// Route autentikasi
Auth::routes(['register' => false]);

// Route pencarian
Route::get('siswa/cari', 'SiswaController@cari');

// Route controller siswa
Route::resource('siswa', 'SiswaController');

    // Route::get('siswa', 'SiswaController@index');
    // Route::get('siswa/create', 'SiswaController@create');
    // Route::get('siswa/{siswa}', 'SiswaController@show');
    // Route::post('siswa', 'SiswaController@store');
    // Route::get('siswa/{siswa}/edit', 'SiswaController@edit');
    // Route::patch('siswa/{siswa}', 'SiswaController@update');
    // Route::delete('siswa/{siswa}', 'SiswaController@destroy');

// Route controller kelas
Route::resource('kelas', 'KelasController')->parameters([
    'kelas' => 'kelas'
]);

// Route controller hobi
Route::resource('hobi', 'HobiController');

// Route controller ekskul
Route::resource('ekskul', 'EkskulController');

// Route controller user
Route::resource('user', 'UserController');

