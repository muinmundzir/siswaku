@extends('template')

@section('main')
    <div id='siswa'>
        <h2>Siswa</h2>

        @include('_partial.flash_message')
        @include('siswa.form_pencarian')

        @if (count($siswa_list) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Nomor Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($siswa_list as $siswa)
                    <tr>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->nama_siswa }}</td>
                        <td>{{ $siswa->kelas->nama_kelas}}</td>
                        <td>{{ $siswa->tanggal_lahir->format('d-m-Y') }}</td>
                        <td>{{ $siswa->jenis_kelamin }}</td>
                        <td>{{ !empty($siswa->telepon->nomor_telepon) ? $siswa->telepon->nomor_telepon : '-'}}</td>
                        <td> 
                            <div class="box-button">
                                {{ link_to('siswa/'.$siswa->id, 'Detail', ['class' => 'btn btn-success btn-sm']) }}
                            </div>
                            <div class="box-button">
                                {{ link_to('siswa/'.$siswa->id.'/edit', 'Edit', ['class' => 'btn btn-warning btn-sm'])}}
                            </div>
                            <div class="box-button">
                                {!! Form::open(['method' => 'DELETE', 'action' => ['SiswaController@destroy', $siswa->id]]) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Tidak ada data siswa.</p>
        @endif

        <div class="table-nav">
            <div class="jumlah-data">
                <strong> Jumlah Siswa : {{ $jumlah_siswa }}</strong>
            </div>
            <div class="paging">
                {{ $siswa_list->links() }}
            </div>
        </div>

        <div class="tombol-nav">
            <div>
                <a href="{{ url('siswa/create')}}" class="btn btn-primary">Tambah Siswa</a>
            </div>
        </div>

    </div>
@endsection