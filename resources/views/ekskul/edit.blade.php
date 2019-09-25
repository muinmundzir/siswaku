@extends('template')

@section('main')
    <div id="ekskul">
        <h2>Edit Ekskul</h2>

        {!! Form::model($ekskul, ['method' => 'PATCH', 'action' => ['EkskulController@update', $ekskul->id]]) !!}
            @include('ekskul.form', ['submitButtonText' => 'Update'])
        {!! Form::close() !!}

    </div>
@endsection

@section('footer')
    @include('footer')
@endsection