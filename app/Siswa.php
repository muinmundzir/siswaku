<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'tanggal_lahir',
        'jenis_kelamin'
    ];

    protected $dates = ['tanggal_lahir'];

    public function telepon()
    {
        return $this->hasOne('App\Telepon', 'id_siswa');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    }
}
