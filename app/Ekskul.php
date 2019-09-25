<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekskul';

    protected $fillable = ['nama_ekskul'];

    public function siswa()
    {
        return $this->belongsToMany('App\Siswa', 'ekskul_siswa', 'id_ekskul', 'id_siswa');
    }
}
