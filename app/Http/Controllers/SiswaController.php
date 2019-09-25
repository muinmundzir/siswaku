<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SiswaRequest;
use App\Siswa;
use App\Telepon;
use App\Kelas;
use App\Hobi;
use App\Ekskul;
use Storage;
use Session;

class SiswaController extends Controller
{
    public function __contruct() {
        $this->middleware('auth', ['except' => [
            'index',
            'show',
            'cari',
        ]]);
    }

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

        Session::flash('flash_message', 'Data siswa berhasil disimpan.');

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

        //Insert Ekskul
        $siswa->ekskul()->attach($request->input('ekskul_siswa'));

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

        //Update Ekskul
        $siswa->ekskul()->sync($request->input('ekskul_siswa'));
        
        Session::flash('flash_message', 'Data siswa berhasil diupdate.');
        return redirect('siswa');
    }

    public function destroy(Siswa $siswa) {
        //Hapus foto kalau ada
        $this->hapusFoto($siswa);

        $siswa->delete();
        Session::flash('flash_message', 'Data ' .$siswa->nama_siswa. ' berhasil dihapus.');
        Session::flash('penting', true);
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

    public function cari(Request $request){
        $kata_kunci =  trim($request->input('kata_kunci'));

        if (!empty($kata_kunci)) {
            $jenis_kelamin = $request->input('jenis_kelamin');
            $id_kelas = $request->input('id_kelas');

            // Query
            $query = Siswa::where('nama_siswa', 'LIKE', '%' .$kata_kunci. '%');
            (!empty($jenis_kelamin)) ? $query->JenisKelamin($jenis_kelamin) : '';
            (!empty($id_kelas)) ? $query->Kelas($id_kelas) : '';

            $siswa_list = $query->paginate(2);

            // URL Links pagination
            $pagination = (!empty($jenis_kelamin)) ?
            $siswa_list->appends(['jenis_kelamin' => $jenis_kelamin]) : '';
            $pagination = (!empty($id_kelas)) ? $pagination =
            $siswa_list->appends(['id_kelas' => $id_kelas]) : '';
            $pagination = $siswa_list->appends(['kata_kunci', $kata_kunci]);

            $jumlah_siswa = $siswa_list->total();
            return view('siswa.index', compact('siswa_list', 'kata_kunci',
            'pagination', 'jumlah_siswa', 'id_kelas', 'jenis_kelamin'));
        }

        return redirect('siswa');
    }
}
