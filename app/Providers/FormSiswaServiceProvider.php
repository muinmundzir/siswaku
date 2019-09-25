<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Kelas;
use App\Hobi;
use App\Ekskul;

class FormSiswaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('siswa.form', function($view) {
            $view->with('list_kelas', Kelas::pluck('nama_kelas', 'id'));
            $view->with('list_hobi', Hobi::pluck('nama_hobi', 'id'));
            $view->with('ekskul_list', Ekskul::pluck('nama_ekskul', 'id'));
        });

        view()->composer('siswa.form_pencarian', function($view) {
            $view->with('list_kelas', Kelas::pluck('nama_kelas', 'id'));
        });
    }
}
