@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nomor</th>   
                        <th>Kode Sub Kegiatan</th>                       
                        <th>Sub Kegiatan</th>
                        <th>Kode Akun</th>
                        <th>Akun</th>
                        <th>Nilai Rincian</th>
                        <th>Jenis</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dpaData as $dpa)
                    <tr class="row-clickable" data-dpa-id="{{ $dpa->id }}">
                        <td>{{ $dpa->id }}</td>
                        <td>{{ $dpa->kode_sub_kegiatan }}</td>
                        <td>{{ $dpa->nama_sub_kegiatan }}</td>
                        <td>{{ $dpa->kode_akun }}</td>
                        <td>{{ $dpa->nama_akun }}</td>
                        <td>Rp. {{ number_format($dpa->nilai_rincian, 0, ',', '.') }}</td>
                        <td>{{ $dpa->tipe }}</td>
                        <td>
                            @if ($dpa->assignedUser)
                            {{ $dpa->assignedUser->full_name }}
                            @else
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                    Assign PPTK
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
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




                        

    

    <form action="{{ route('pengadaan.store_pengadaan') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">

        <div class="form-group">
            <label for="nama_rekanan">Pilih Rekanan:</label>
            <select class="form-control" name="nama_rekanan" id="nama_rekanan">
                @foreach ($rekanans as $rekanan)
                <option value="{{ $rekanan->nama_rekanan }}">{{ $rekanan->nama_rekanan }}</option>
                @endforeach
                <!-- Tambahkan rekanan lainnya sesuai kebutuhan -->
            </select>
        </div>
        
        <div class="form-group">
            <label for="pilihan">Pilih Jenis Dokumen:</label>
            <select class="form-control" name="pilihan" id="pilihan">
                <option value="Kontrak">Kontrak</option>
                <option value="Pemesanan">Pemesanan</option>
                <option value="E-Purchasing">E-Purchasing</option>
                <option value="Lainnya">Lainnya</option>
                <!-- Tambahkan pilihan lainnya sesuai kebutuhan -->
            </select>
        </div>
        
        <div class="form-group">
            <label for="keterangan">Keterangan:</label>
            <textarea class="form-control" name="keterangan" id="keterangan" rows="4" cols="50"></textarea>
        </div>
        
        <div class="form-group">
            <label for="berkas">Berkas:</label>
            <input type="file" class="form-control-file" name="berkas" id="berkas">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
