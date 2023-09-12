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

    <form action="{{ route('bendahara.store_spm') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="dpa_id" value="{{ $dpa_id }}">

        <div class="form-group">
            <label for="no_spm">Nomor SPM:</label>
            <input type="text" class="form-control" id="no_spm" name="no_spm" required>
        </div>

        <div class="form-group">
            <label for="no_sptjmspm">Nomor SPTJM SPM:</label>
            <input type="text" class="form-control" id="no_sptjmspm" name="no_sptjmspm" required>
        </div>

        <div class="form-group">
            <label for="nilai_spm">Nilai SPM:</label>
            <input type="text" class="form-control" id="nilai_spm" name="nilai_spm" required>
        </div>

        <div class="form-group">
            <label for="ket_spm">Keterangan:</label>
            <textarea class="form-control" id="ket_spm" name="ket_spm" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="spm">Upload SPM:</label>
            <input type="file" class="form-control-file" id="spm" name="spm" accept=".pdf, .doc, .docx" required>
        </div>

        <div class="form-group">
            <label for="sptjmspm">Upload SPTJM SPM:</label>
            <input type="file" class="form-control-file" id="sptjmspm" name="sptjmspm" accept=".pdf, .doc, .docx" required>
        </div>

        <div class="form-group">
            <label for="lampiran_sumber_dana">Upload Lampiran Sumber Dana:</label>
            <input type="file" class="form-control-file" id="lampiran_sumber_dana" name="lampiran_sumber_dana" accept=".pdf, .doc, .docx" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
