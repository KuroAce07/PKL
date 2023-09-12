@extends('layouts.app')

@section('title', 'View DPA')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View RAK</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of RAK</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                                <th>Nomor</th>
                                <th>Nama Kegiatan</th>
                                <th>Sub Kegiatan</th>
                                <th>Nama Akun</th>
                                <th>Bulan 1</th>
                                <th>Bulan 2</th>
                                <th>Bulan 3</th>
                                <th>Bulan 4</th>
                                <th>Bulan 5</th>
                                <th>Bulan 6</th>
                                <th>Bulan 7</th>
                                <th>Bulan 8</th>
                                <th>Bulan 9</th>
                                <th>Bulan 10</th>
                                <th>Bulan 11</th>
                                <th>Bulan 12</th>
                                <th>Total RAK</th>
                                <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpaData as $dpa)
                        <tr>
                            {{-- <tr class="row-clickable" data-dpa-id="{{ $dpa->id }}"> --}}
                                <td>{{ $dpa->id }}</td>
                                <td>{{ $dpa->nama_kegiatan }}</td>
                                <td>{{ $dpa->nama_sub_kegiatan }}</td>
                                <td>{{ $dpa->nama_akun }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_1, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_2, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_3, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_4, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_5, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_6, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_7, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_8, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_9, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_10, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_11, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->bulan_12, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->total_rak, 0, ',', '.') }}</td>
                                <td>
                                    <div class="btn-group">
                                        @hasrole('Admin')
                                        <a href="{{ route('editDPA', ['id' => $dpa->id]) }}" class="btn btn-primary edit-btn">Edit</a>
                                        <button type="button" class="btn btn-danger delete-btn" onclick="deleteDpa('{{ route('ViewDPA.destroy', $dpa->id) }}')">Delete</button>
                                        @endhasrole
                                        <a href="{{ route('ViewDPA.realrak', ['id' => $dpa->id]) }}" class="btn btn-info view-pdf-btn" target="_blank">Lihat Realisasi</a>
                                    </div>
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
</style>