@extends('template')

@section('main')
    <div id="ekskul">
        <h2>Tambah Ekskul</h2>

        {!! Form::open(['url' => 'ekskul']) !!}
            @include('ekskul.form', ['submitButtonText' => 'Simpan'])
        {!! Form::close() !!}
        
    </div>
@endsection

@section('footer')
    @include('footer')
@endsection