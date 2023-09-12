@extends('layouts.app')

@section('title', 'Rekanan List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rekanan List</h1>
        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Semua Rekanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Rekanan</th>
                                <th>Jenis Rekanan</th>
                                <th>NIK Rekanan</th>
                                <th>Nomor NPWP</th>
                                <th>Nama Rekanan</th>
                                <th>Nama Instansi</th>
                                <th>Jenis Usaha</th>
                                <th>Nama Bank</th>
                                <th>Nama Cabang</th>
                                <th>Nomor Rekening</th>
                                <th>Nama Rekening</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekanans as $rekanan)
                                <tr>
                                    <td>{{ $rekanan->kode_rekanan }}</td>
                                    <td>{{ $rekanan->jenis_rekanan }}</td>
                                    <td>{{ $rekanan->nik_rekanan }}</td>
                                    <td>{{ $rekanan->nomor_npwp }}</td>
                                    <td>{{ $rekanan->nama_rekanan }}</td>
                                    <td>{{ $rekanan->nama_instansi }}</td>
                                    <td>{{ $rekanan->jenis_usaha }}</td> 
                                    <td>{{ $rekanan->nama_bank }}</td>
                                    <td>{{ $rekanan->nama_cabang }}</td>
                                    <td>{{ $rekanan->nomor_rekening }}</td>
                                    <td>{{ $rekanan->nama_rekening }}</td>
                                    <td>{{ $rekanan->telepon }}</td>
                                    <td>{{ $rekanan->alamat }}</td>
                                    <td class="d-flex justify-content-between">
                                <a href="{{ route('rekanan.edit', $rekanan->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('rekanan.destroy', $rekanan->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this rekanan?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add any required scripts here -->
@endsection
