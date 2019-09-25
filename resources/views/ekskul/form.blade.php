@if (isset($ekskul))
    {!! Form::hidden('id', $ekskul->id) !!}
@endif

@if ($errors->any())
    <div class="form-group {{ $errors->has('nama_ekskul') ? 'has-error' : 'has-success'}}">
@else
    <div class="form-group">
@endif
    {!! Form::label('nama_ekskul', 'Nama Ekskul:', ['class' => 'control-label']) !!}
    {!! Form::text('nama_ekskul', null, ['class' => 'form-control']) !!}
    @if ($errors->has('nama_ekskul'))
        <span class="help-block">{{ $errors->first('nama_ekskul')}}</span>
    @endif
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-sm']) !!}
</div>