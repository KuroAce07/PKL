@extends('layouts.app')

@section('title', 'Realisasi RAK')

@section('content')

{{-- ADD --}}
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sumber Dana</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambahkan Sumber Dana</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('ViewDPA.sumberdana') }}" method="post">
                @csrf <!-- Add CSRF token for security -->
                <div class="form-group">
                    <label for="sumber_dana">Sumber Dana</label>
                    <input type="text" class="form-control" id="sumber_dana" name="sumber_dana" placeholder="Masukkan Sumber Dana">
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
        <h1 class="h3 mb-0 text-gray-800">Daftar Sumber Dana</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sumber Dana</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Sumber Dana</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($sumberdanadata as $entry)
                <tr>
                    <td>{{ $entry->id }}</td>
                    <td>{{ $entry->Sumber_Dana }}</td>
                    <td>{{ $entry->keterangan }}</td>
                    <td>
                        <form action="{{ route('ViewDPA.deletesumberdana', ['id' => $entry->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @if(count($sumberdanadata) == 0)
                <p>No entries found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
