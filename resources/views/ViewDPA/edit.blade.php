@extends('layouts.app')

@section('title', 'Edit DPA')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit DPA</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit DPA</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('updateDPA', ['dpa' => $dpa->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $dpa->tahun }}">
                </div>
                <div class="form-group">
                    <label for="daerah">Daerah</label>
                    <input type="text" class="form-control" id="daerah" name="daerah" value="{{ $dpa->daerah }}">
                </div>
                <div class="form-group">
                    <label for="kode_urusan">Kode Urusan</label>
                    <input type="text" class="form-control" id="kode_urusan" name="kode_urusan" value="{{ $dpa->kode_urusan }}">
                </div>
                <div class="form-group">
                    <label for="kode_sub_skpd">Kode Sub SKPD</label>
                    <input type="text" class="form-control" id="kode_sub_skpd" name="kode_sub_skpd" value="{{ $dpa->kode_sub_skpd }}">
                </div>
                <div class="form-group">
                    <label for="nama_sub_skpd">Nama Sub SKPD</label>
                    <input type="text" class="form-control" id="nama_sub_skpd" name="nama_sub_skpd" value="{{ $dpa->nama_sub_skpd }}">
                </div>
                <div class="form-group">
                    <label for="kode_program">Kode Program</label>
                    <input type="text" class="form-control" id="kode_program" name="kode_program" value="{{ $dpa->kode_program }}">
                </div>
                <div class="form-group">
                    <label for="nama_program">Nama Program</label>
                    <input type="text" class="form-control" id="nama_program" name="nama_program" value="{{ $dpa->nama_program }}">
                </div>
                <div class="form-group">
                    <label for="kode_kegiatan">Kode Kegiatan</label>
                    <input type="text" class="form-control" id="kode_kegiatan" name="kode_kegiatan" value="{{ $dpa->kode_kegiatan }}">
                </div>
                <div class="form-group">
                    <label for="nama_kegiatan">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{ $dpa->nama_kegiatan }}">
                </div>
                <div class="form-group">
                    <label for="kode_sub_kegiatan">Kode Sub Kegiatan</label>
                    <input type="text" class="form-control" id="kode_sub_kegiatan" name="kode_sub_kegiatan" value="{{ $dpa->kode_sub_kegiatan }}">
                </div>
                <div class="form-group">
                    <label for="nama_sub_kegiatan">Nama Sub Kegiatan</label>
                    <input type="text" class="form-control" id="nama_sub_kegiatan" name="nama_sub_kegiatan" value="{{ $dpa->nama_sub_kegiatan }}">
                </div>
                <div class="form-group">
                    <label for="kode_akun">Kode Akun</label>
                    <input type="text" class="form-control" id="kode_akun" name="kode_akun" value="{{ $dpa->kode_akun }}">
                </div>
                <div class="form-group">
                    <label for="nama_akun">Nama Akun</label>
                    <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="{{ $dpa->nama_akun }}">
                </div>
                <div class="form-group">
                    <label for="nilai_rincian">Nilai Rincian</label>
                    <input type="text" class="form-control" id="nilai_rincian" name="nilai_rincian" value="Rp. {{ number_format($dpa->nilai_rincian, 0, ',', '.') }}">
                </div>
                <div class="form-group">
    <label for="pptk">PPTK</label>
    @if ($dpa->assignedUser)
        <select class="form-control" id="pptk" name="pptk">
            <option value="{{ $dpa->assignedUser->id }}" selected>
                {{ $dpa->assignedUser->first_name }} {{ $dpa->assignedUser->last_name }}
            </option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->first_name }} {{ $user->last_name }}
                </option>
            @endforeach
        </select>
    @else
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                Assign
            </button>
            <div class="dropdown-menu">
                @foreach ($users as $user)
                    <a class="dropdown-item" href="{{ route('ViewDPA.assignDpa', ['dpaId' => $dpa->id, 'userId' => $user->id]) }}">
                        {{ $user->first_name }} {{ $user->last_name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>


                {{-- Submit button --}}
                <button type="submit" class="btn btn-primary">Update DPA</button>
            </form>
        </div>
    </div>
</div>
@endsection
