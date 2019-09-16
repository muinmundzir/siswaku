@extends('template')

@section('main')
    <div id="siswa">
        <h2>Tambah Siswa</h2>
        {!! Form::open(['url' => 'siswa', 'files' => true]) !!}
        @include('siswa.form', ['submitButtonText' => 'Simpan'])
        {!! Form::close() !!}
    </div>
@endsection

@section('footer')
    <div id="footer">
        <p>&copy; SiswakuApp</p>
    </div>
@endsection