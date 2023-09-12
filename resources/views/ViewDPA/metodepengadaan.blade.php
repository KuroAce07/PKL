@extends('layouts.app')

@section('title', 'Realisasi RAK')

@section('content')

{{-- ADD --}}
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Metode Pengadaan</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambahkan Metode Pengadaan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('ViewDPA.metodepengadaan') }}" method="post">
                @csrf <!-- Add CSRF token for security -->
                <div class="form-group">
                    <label for="metode_pengadaan">Metode Pengadaan</label>
                    <input type="text" class="form-control" id="metode_pengadaan" name="metode_pengadaan" placeholder="Masukkan Metode Pengadaan">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Tambahkan Keterangan Jika Ada"></textarea>
                </div>
                <!-- Add more form fields as needed -->
            
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </div>
    </div>
</div>

{{-- SHOW --}}
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Metode Pengadaan</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Metode Pengadaan</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Metode Pengadaan</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($metodepengadaanData as $entry)
                <tr>
                    <td>{{ $entry->id }}</td>
                    <td>{{ $entry->metode_pengadaan }}</td>
                    <td>{{ $entry->keterangan }}</td>
                    <td>
                        <form action="{{ route('ViewDPA.deleteMetodePengadaan', ['id' => $entry->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @if(count($metodepengadaanData) == 0)
                <p>No entries found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
