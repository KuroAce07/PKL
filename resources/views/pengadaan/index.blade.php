@extends('layouts.app')

@section('title', 'View DPA')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berkas Pemilihan</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Berkas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID DPA</th>
                            <th>Pilihan</th>
                            <th>Berkas</th>
                            <th>Keterangan</th>
                            @if (Auth::user()->hasRole('Pejabat Pengadaan'))
                            <th>Rekanan</th>
                            <th>action</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($berkass as $berkas)
                        <tr>
                            <td>{{ $berkas->dpa_id }}</td>
                            <td>{{ $berkas->pilihan }}</td>
                            <td>{{ $berkas->berkas }}</td>
                            <td>{{ $berkas->keterangan }}</td>
                            <td>{{ $berkas->nama_rekanan }}</td>
                            @if (Auth::user()->hasRole('Pejabat Pengadaan'))
                            <td><form action="{{ route('pengadaan.delete', ['id' => $berkas->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form><a href="{{ route('pengadaan.edit', ['id' => $berkas->id]) }}" class="btn btn-primary">Edit</a></td>
                            @endif
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
<style>
    
    .custom-table {
        border: 1px solid #000 !important; /* Set the border color to black (#000) with !important */
        border-collapse: collapse; /* Collapse borders into a single line */
    }

    .custom-table thead tr th {
        font-size: 1.2rem;
        font-weight: bold;
        background-color: #f7f7f7;
        color: #333;
        text-align: center;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }

    /* Override Bootstrap's default styles for table border color */
    .table-bordered th,
    .table-bordered td {
        border-color: #000 !important; /* Set the border color to black (#000) with !important */
    }

    /* Style for the modal */
    .modal-content {
        border-radius: 0.5rem;
    }

    .modal-header {
        background-color: #007bff;
        color: #fff;
    }

    .modal-body {
        padding: 2rem;
    }

    .modal-title {
        font-size: 1.5rem;
    }

    .modal-body p {
        font-size: 1.1rem;
        line-height: 1.5;
    }

    .modal-body p strong {
        color: #007bff;
    }

    .modal-body p.mb-0 {
        margin-bottom: 0;
    }

    .modal-body p.mb-2 {
        margin-bottom: 0.5rem;
    }
    .separator-row td {
        border-bottom: 1px solid #ddd;
    }
    .table-bordered tr:not(:last-child) {
        border-bottom: 1px solid #dee2e6;
    }
    
    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 10px;
    }
    .custom-table {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .custom-table__column {
        flex: 1;
        padding: 10px;
        border: 1px solid #dee2e6;
    }

    .custom-table__column--uraian {
        flex-basis: 70%;
    }

    .custom-table__column--jumlah {
        flex-basis: 30%;
    }
</style>