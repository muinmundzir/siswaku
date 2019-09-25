@extends('template')

@section('main')
    <div id="ekskul">
        <h2>Ekskul</h2>

        @include('_partial.flash_message')

        @if (count($ekskul_list) > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ekskul</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @php
                    $i = 0;    
                @endphp

                @foreach ($ekskul_list as $ekskul)
                <tbody>
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $ekskul->nama_ekskul }}</td>
                            <td>
                                <div class="box-button">
                                    {!! link_to('ekskul/'.$ekskul->id.'/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) !!}
                                </div>
                                <div class="box-button">
                                    {!! Form::open(['method' => 'DELETE', 
                                    'action' => ['EkskulController@destroy', $ekskul->id]]) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        @else
            <p>Tidak ada data ekskul.</p>
        @endif
    </div>

    <div class="tombol-nav">
        <a href="ekskul/create" class="btn btn-primary">Tambah Ekskul</a>
    </div>

@endsection

@section('footer')
    @include('footer')
@endsection