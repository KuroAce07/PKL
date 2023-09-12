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
                        <th>PPTK</th>
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

    <form action="{{ route('bendahara.store_spp') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">

        <div class="form-group">
            <label for="no_spp">Nomor SPP:</label>
            <input type="text" class="form-control" id="no_spp" name="no_spp" required>
        </div>

        <div class="form-group">
            <label for="no_sptjmspp">Nomor SPTJM SPP:</label>
            <input type="text" class="form-control" id="no_sptjmspp" name="no_sptjmspp" required>
        </div>

        <div class="form-group">
            <label for="nilai_spp">nilai:</label>
            <input class="form-control" id="nilai_spp" name="nilai_spp" rows="4" required>
        </div>

        <div class="form-group">
            <label for="ket_spp">Keterangan:</label>
            <textarea class="form-control" id="ket_spp" name="ket_spp" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="spp">Upload SPP:</label>
            <input type="file" class="form-control-file" id="spp" name="spp" accept=".pdf, .doc, .docx" required>
        </div>

        <div class="form-group">
            <label for="sptjmspp">Upload SPTJM SPP:</label>
            <input type="file" class="form-control-file" id="sptjmspp" name="sptjmspp" accept=".pdf, .doc, .docx" required>
        </div>

        <div class="form-group">
            <label for="verif_spp">Upload Verifikasi SPP:</label>
            <input type="file" class="form-control-file" id="verif_spp" name="verif_spp" accept=".pdf, .doc, .docx" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
