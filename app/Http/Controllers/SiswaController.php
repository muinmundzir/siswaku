<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SiswaRequest;
use App\Siswa;
use App\Telepon;
use App\Kelas;
use App\Hobi;
use Storage;

class SiswaController extends Controller
{
    public function index() {
        $siswa_list = Siswa::orderBy('nisn')
                    ->paginate(10);
        $jumlah_siswa = Siswa::count();
        return view('siswa.index', compact('siswa_list', 'jumlah_siswa'));
    }

    public function create() {
        return view("siswa.create");
    }

    public function store(SiswaRequest $request) {  
        $input = $request->all();

        //Upload Foto
        if ($request->hasFile('foto')) {
            $input['foto'] = $this->uploadFoto($request);
        }

        //Insert Siswa
        $siswa = Siswa::create($input);
        
        //Insert Telepon
        if($request->filled('nomor_telepon')){
            $this->insertTelepon($request, $siswa);
        }

        //Insert Hobi
        $siswa->hobi()->attach($request->input('hobi_siswa'));

        return redirect('siswa');
    }

    public function show(Siswa $siswa) {
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa) {
        if (!empty($siswa->telepon->nomor_telepon)) {
            $siswa->nomor_telepon =  $siswa->telepon->nomor_telepon;
        }

        return view('siswa.edit', compact('siswa'));
    }

    public function update(SiswaRequest $request, Siswa $siswa) {
        $input = $request->all();

        //Update Foto
        if($request->hasFile('foto')){
            $input['foto'] = $this->uploadFoto($request, $siswa);
        }

        //Update Siswa
        $siswa->update($input);

        //Update nomor telepon
        $this->updateTelepon($request, $siswa);

        //Update Hobi
        $siswa->hobi()->sync($request->input('hobi_siswa'));

        return redirect('siswa');
    }

    public function destroy(Siswa $siswa) {
        //Hapus foto kalau ada
        $this->hapusFoto($siswa);

        $siswa->delete();
        return redirect('siswa');
    }

    private function insertTelepon(SiswaRequest $request, Siswa $siswa){
        $telepon = new Telepon;
        $telepon->nomor_telepon =  $request->input('nomor_telepon');
        $siswa->telepon()->save($telepon);
    }

    private function updateTelepon(SiswaRequest $request, Siswa $siswa){
        if ($siswa->telepon) {
            if($request->filled('nomor_telepon')){
                $telepon = $siswa->telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $siswa->telepon()->save($telepon);
            }
            else {
                $siswa->telepon()->delete();
            }
        }
        else {
            if($request->filled('nomor_telepon')){
                $telepon = new Telepon;
                $telepon->nomor_telepon = $request->input('nomor_telepon');
                $siswa->telepon()->save($telepon);
            }
        }
    }

    private function uploadFoto(SiswaRequest $request){
        $foto = $request->file('foto');
        $ext =  $foto->getClientOriginalExtension();

        if ($request->file('foto')->isValid()) {
            $foto_name = date('YmdHis').".$ext";
            $request->file('foto')->move('fotoupload', $foto_name);
            return $foto_name;
        }
        return false;
    }

    private function updateFoto(SiswaRequest $request, Siswa $siswa){
        //Jika user mengisi foto
        if($request->hasFile('foto')){
            //Hapus foto lama jika ada foto baru
            $exist = Storage::disk('foto')->exists($siswa->foto);
            if (isset($siswa->foto) && $exist) {
                $delete = Storage::disk('foto')->delete($siswa->foto);
            }

            //Upload foto baru
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            if ($request->file('foto')->isValid()) {
                $foto_name = date('YmdHis').".$ext";
                $upload_path = 'fotoupload';
                $request->file('foto')->move($upload_path, $foto_name);
                return $foto_name;
            }
        }
    }

    private function hapusFoto(Siswa $siswa){
        $is_foto_exist = Storage::disk('foto')->exists($siswa->foto);

        if ($is_foto_exist) {
            Storage::disk('foto')->delete($siswa->foto);
        }
    }
}
