@extends('layouts.app')

@section('title', 'View DPA')

@section('content')

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View DPA</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of DPAs</h6>
        </div>
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
                            <th>Status</th>
                            <th>Detail</th>
                            <th>Jenis</th>
                            @hasrole('Admin')
                            <th>Assign</th>
                            <th>Actions</th>
                            @endhasrole
                            @hasrole('Pejabat Pengadaan')
                            <th>RUP</th>
                            <th>Keterangan</th>
                            @endhasrole

                            @hasrole('PPTK')
                            @if ($column == 'A')
                            <th>Pejabat Pengadaan</th>
                            @endif
                            @endhasrole

                            @hasrole('Pejabat Pengadaan')
                            <th>Lihat Keterangan Dari PPTK</th>
                            @endhasrole

                            @hasrole('PPTK')
                            @if ($column == 'B')
                            <th>Pembantu PPTK</th>
                            @endif
                            @endhasrole

                            @hasrole('Pembantu PPTK')
                            <th>Lihat Keterangan Dari PPTK</th>
                            @endhasrole

                            @hasrole('PPTK')
                            @if ($column == 'C')
                            <th>Bendahara</th>
                            @endif
                            @endhasrole

                            @hasrole('Bendahara')
                            <th>Lihat Keterangan Dari PPTK</th>
                            @endhasrole

                            @hasrole('PPTK')
                            <th>Input<span class="hide-underscore">_</span>Data<span class="hide-underscore">_</span>RUP
                            <th>Pilih<span class="hide-underscore">_</span>Sumber<span class="hide-underscore">_</span>Dana
                            </th>
                            @endhasrole
                            @hasrole(['Pembantu PPTK', 'PPTK', 'Bendahara'])
                            <th>Kelengkapan Dokumen</th>
                            @endhasrole
                            @hasrole('Bendahara')
                            <th>Form Ceklis</th>
                            @endhasrole
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($dpaData as $dpa)
                        <tr>
                            {{--
                        <tr class="row-clickable" data-dpa-id="{{ $dpa->id }}"> --}}
                            <td>{{ $dpa->id_dpa }}</td>
                            <td>{{ $dpa->kode_sub_kegiatan }}</td>
                            <td>{{ $dpa->nama_sub_kegiatan }}</td>
                            <td>{{ $dpa->kode_akun }}</td>
                            <td>{{ $dpa->nama_akun }}</td>
                            <td>Rp. {{ number_format($dpa->nilai_rincian, 0, ',', '.') }}</td>
                            <td>@if(!is_null($dpa->user_id4))
                                Selesai
                                @else
                                Belum Selesai
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <!-- Detail button trigger -->
                                    <button type="button" class="btn btn-info detail-btn" data-toggle="modal" data-target="#detailModal{{ $dpa->id }}">
                                            Detail
                                        </button>
                                    <!-- Tracking button trigger -->
                                    <button type="button" class="btn btn-Primary tracking-btn" data-toggle="modal" data-target="#trackingModal{{ $dpa->id }}">
                                            Tracking
                                        </button>

                                    @if ($dpa->tipe === 'DPPA')
                                    <a href="{{ route('ViewDPA.dppa', ['id_dpa'=>$dpa->id_dpa]) }}"
                                        class="btn btn-Success" style="text-decoration: none; color: white;">Cek DPA</a>
                                    @endif
                                    <a href="{{ route('ViewDPA.realrak', ['id' => $dpa->id_dpa]) }}"
                                        class="btn btn-warning" target="_blank">RAK</a>
                                </div>
                            </td>
                            <td>{{ $dpa->tipe }}</td>

                            @hasrole('Admin')
                            <td>
                                @if ($dpa->assignedUser)
                                {{ $dpa->assignedUser->full_name }}
                                @else
                                <button type="button" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                            Assign PPTK
                                        </button>

                                <div class="dropdown-menu">
                                    @foreach ($users as $user)
                                    <a class="dropdown-item"
                                        href="{{ route('ViewDPA.assignDpa', ['dpaId' => $dpa->id, 'userId' => $user->id]) }}">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </a>
                                    @endforeach
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('editDPA', ['id' => $dpa->id]) }}"
                                        class="btn btn-primary edit-btn">Edit</a>
                                    <button type="button" class="btn btn-danger delete-btn" onclick="deleteDpa('{{ route('ViewDPA.destroy', $dpa->id) }}')">Delete</button>
                                    @endhasrole

                                    @hasrole('Pejabat Pengadaan')
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitFormRUP-{{ $dpa->id_dpa }}">
                                                Lihat RUP
                                            </button>
                                <div class="modal fade" id="submitFormRUP-{{ $dpa->id_dpa }}" tabindex="-1"
                                    role="dialog" aria-labelledby="submitFormRUPLabel-{{ $dpa->id_dpa }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST"
                                                action="{{ route('submitRUP', ['dpaId' => $dpa->id]) }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="submitFormRUPLabel-{{ $dpa->id_dpa }}">
                                                        Submit RUP Form</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="rup-{{ $dpa->id_dpa }}">RUP:</label>
                                                        <input id="rup-{{ $dpa->id_dpa }}" name="rup" class="form-control" value="{{ $dpa->rup }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nilairup-{{ $dpa->id_dpa }}">Nilai RUP:</label>
                                                        <input id="nilairup-{{ $dpa->id_dpa }}" name="nilairup" class="form-control" value="{{ $dpa->nilairup }}">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @php
                            $isDpaAlreadyCreated2 = \App\Models\Pengadaan::where('dpa_id', $dpa->id)->exists();
                            @endphp
                            @if (!$isDpaAlreadyCreated2)
                            <!-- Check if DPA hasn't been created -->

                            <td><a href="{{ route('pengadaan.create_pengadaan', ['id' => $dpa->id]) }}"
                                    class="btn btn-primary edit-btn">Buat Dokumen Pemilihan</a></td>
                            @else
                            <td>Dokumen Sudah Ada</td>
                            @endif
                            @endhasrole
                            </div>
                            </td>

            @hasrole('Bendahara')
            {{-- <td>
                <div class="btn-group">
                    <a href="{{ route('ceklisform.index', ['id' => $dpa->id]) }}"
                        class="btn btn-primary edit-btn">Ceklis</a>
                    <a href="{{ route('bendahara.create_spp', ['id' => $dpa->id]) }}"
                        class="btn btn-success edit-btn">SPP</a>
                    <a href="{{ route('bendahara.create_spm', ['id' => $dpa->id]) }}"
                        class="btn btn-warning edit-btn">SPM</a>
                    <a href="{{ route('bendahara.create_sp2d', ['id' => $dpa->id]) }}"
                        class="btn btn-danger edit-btn">SP2D</a>
                </div>
            </td> --}}
            @endhasrole

@hasrole('PPTK')
@if ($column == 'A')
<td>
    <!-- Assign Pejabat pengadaan -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descriptionModal-{{ $dpa->id_dpa }}">
        Lihat Keterangan Disposisi
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="descriptionModal-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog"
        aria-labelledby="descriptionModalLabel-{{ $dpa->id_dpa }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('updateDescriptionPP', ['dpaId' => $dpa->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="descriptionModalLabel-{{ $dpa->id_dpa }}">Edit Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="descriptionPP-{{ $dpa->id_dpa }}">Description:</label>
                            <textarea id="descriptionPP-{{ $dpa->id_dpa }}" name="descriptionPP" class="form-control" rows="5">{{ $dpa->descriptionPP }}</textarea>
                        </div>

                        <!-- Add a hidden input to store the selected Pejabat Pengadaan value -->
                        <input type="hidden" id="pp-value-{{ $dpa->id_dpa }}" name="pp" value="{{ $dpa->user_id2 }}">

                        <!-- Update the Pejabat Pengadaan dropdown -->
                        <div class="btn-group">
                            @if ($dpa->user_id2 && $dpa->pejabatPengadaanUser)
                                {{ $dpa->pejabatPengadaanUser->first_name }} {{ $dpa->pejabatPengadaanUser->last_name }}
                            @else
                                <div class="dropdown">
                                <button type="button" id="assign-btn-{{ $dpa->id_dpa }}" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                    Assign Pejabat Pengadaan
                                </button>
                                <div class="dropdown-menu">
                                    @foreach ($pejabatPengadaanUsers as $pejabatPengadaanUser)
                                        <a class="dropdown-item" href="#" onclick="assignUser({{ $dpa->id_dpa }}, {{ $pejabatPengadaanUser->id }}, '{{ $pejabatPengadaanUser->first_name }} {{ $pejabatPengadaanUser->last_name }}')">
                                            {{ $pejabatPengadaanUser->first_name }} {{ $pejabatPengadaanUser->last_name }}
                                        </a>
                                    @endforeach
                                </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</td>

<!-- JavaScript to handle modal behavior -->
<script>
function assignPP(dpaId, userId, userName) {
    // Update the hidden input with the selected user
    document.getElementById('pp-value-' + dpaId).value = userId;

    // Update the dropdown button text with the selected user's name
    document.getElementById('assign-btn-' + dpaId).textContent = userName;
}
</script>
@endif
@endhasrole

            @hasrole('Pejabat Pengadaan')
            <td>
                <!-- Assign Pejabat pengadaan -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descriptionModal-{{ $dpa->id_dpa }}">
        Lihat Keterangan Disposisi
        </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="descriptionModal-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog"
            aria-labelledby="descriptionModalLabel-{{ $dpa->id_dpa }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('updateDescriptionPP', ['dpaId' => $dpa->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="descriptionModalLabel-{{ $dpa->id_dpa }}">Edit Description</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="descriptionPP-{{ $dpa->id_dpa }}">Description:</label>
                                <textarea id="descriptionPP-{{ $dpa->id_dpa }}" name="descriptionPP" class="form-control" rows="5">{{ $dpa->descriptionPP }}</textarea>
                            </div>

                            <!-- Add a hidden input to store the selected Pejabat Pengadaan value -->
                            <input type = "hidden" id ="pp-value-{{ $dpa->id_dpa }}" name ="pp" value ="{{ $dpa->user_id2 }}">

                            <!-- Update the Pejabat Pengadaan dropdown -->
                            <div class="form-group">
                                <label for ="pp-{{ $dpa->id_dpa }}">Pejabat Pengadaan:</label>
                                @if ($dpa->user_id2 && $dpa->pejabatPengadaanUser)
                                <input type = "text" id ="pp-{{ $dpa->id_dpa }}" class ="form-control" value ="{{ $dpa->pejabatPengadaanUser->first_name }} {{ $dpa->pejabatPengadaanUser->last_name }}" readonly>
                                @else
                                <select id ="pp-{{ $dpa->id_dpa }}" class ="form-control">
                                <option value = "">Assign Pejabat Pengadaan</option>
                                @foreach ($pejabatPengadaanUsers as $pejabatPengadaanUser)
                                <option value="{{ $pejabatPengadaanUser->id }}">{{ $pejabatPengadaanUser->first_name }} {{ $pejabatPengadaanUser->last_name }}</option>
                                @endforeach
                                </select>
                                @endif
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </td>
    @endhasrole

    @hasrole('PPTK')
    @if ($column == 'B')
    <td>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descriptionModalPPPTK-{{ $dpa->id_dpa }}">
Lihat Keterangan Disposisi
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="descriptionModalPPPTK-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog"
    aria-labelledby="descriptionModalLabelPPPTK-{{ $dpa->id_dpa }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('updateDescriptionPPPTK', ['dpaId' => $dpa->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabelPPPTK-{{ $dpa->id_dpa }}">Edit Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descriptionPPPTK-{{ $dpa->id_dpa }}">Description:</label>
                        <textarea id="descriptionPPPTK-{{ $dpa->id_dpa }}" name="descriptionPPPTK" class="form-control" rows="5">{{ $dpa->descriptionPPPTK }}</textarea>
                    </div>

                    <!-- Add a hidden input to store the selected PPPTK value -->
                    <input type="hidden" id="ppptk-value-{{ $dpa->id_dpa }}" name="ppptk" value="{{ $dpa->user_id3 }}">

                    <!-- Update the PPPTK dropdown -->
                    <div class="btn-group">
                    @if ($dpa->user_id3 && $dpa->pembantupptkUsers)
                        {{ $dpa->pembantupptkUsers->first_name }} {{ $dpa->pembantupptkUsers->last_name }}
                    @else
                        <div class="dropdown">
                            <button type="button" id="assign-btn-{{ $dpa->id_dpa }}" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                Assign Pembantu PPTK
                            </button>
                            <div class="dropdown-menu">
                                @foreach ($pembantupptkUsers as $pembantupptkUser)
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); assignPPPTK({{ $dpa->id_dpa }}, {{ $pembantupptkUser->id }}, '{{ $pembantupptkUser->first_name }} {{ $pembantupptkUser->last_name }}')">
                                        {{ $pembantupptkUser->first_name }} {{ $pembantupptkUser->last_name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</td>

<script>
function assignPPPTK(dpaId, userId, userName) {
    // Update the hidden input with the selected user
    document.getElementById('ppptk-value-' + dpaId).value = userId;

    // Update the dropdown button text with the selected user's name
    document.getElementById('assign-btn-' + dpaId).innerHTML = userName;
}
</script>


@endif
@endhasrole

    @hasrole('Pembantu PPTK')
    <td>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descriptionModalPPPTK-{{ $dpa->id_dpa }}">
Lihat Keterangan Disposisi
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="descriptionModalPPPTK-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog"
    aria-labelledby="descriptionModalLabelPPPTK-{{ $dpa->id_dpa }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('updateDescriptionPPPTK', ['dpaId' => $dpa->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabelPPPTK-{{ $dpa->id_dpa }}">Edit Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descriptionPPPTK-{{ $dpa->id_dpa }}">Description:</label>
                        <textarea id="descriptionPPPTK-{{ $dpa->id_dpa }}" name="descriptionPPPTK" class="form-control" rows="5">{{ $dpa->descriptionPPPTK }}</textarea>
                    </div>

                    <!-- Add a hidden input to store the selected PPPTK value -->
                    <input type="hidden" id="ppptk-value-{{ $dpa->id_dpa }}" name="ppptk" value="{{ $dpa->user_id3 }}">

                    <!-- Update the PPPTK dropdown -->
                    <div class="form-group">
                        <label for="ppptk-{{ $dpa->id_dpa }}">Pembantu PPTK:</label>
                        @if ($dpa->user_id3 && $dpa->pembantupptkUsers)
                        <input type="text" id="ppptk-{{ $dpa->id_dpa }}" class="form-control" value="{{ $dpa->pembantupptkUsers->first_name }} {{ $dpa->pembantupptkUsers->last_name }}" readonly>
                        @else
                        <select id="ppptk-{{ $dpa->id_dpa }}" class="form-control">
                        <option value="">Assign Pembantu PPTK</option>
                        @foreach ($pembantupptkUsers as $pembantupptkUser)
                        <option value="{{ $pembantupptkUser->id }}">{{ $pembantupptkUser->first_name }} {{ $pembantupptkUser->last_name }}</option>
                        @endforeach
                        </select>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</td>
@endhasrole

@hasrole('PPTK')
@if ($column == 'C')
<td>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descriptionModalPP-{{ $dpa->id_dpa }}">
        Lihat Keterangan Disposisi
    </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="descriptionModalPP-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog"
        aria-labelledby="descriptionModalPPLabel-{{ $dpa->id_dpa }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('updateDescription', ['dpaId' => $dpa->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="descriptionModalPPLabel-{{ $dpa->id_dpa }}">Edit Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description-{{ $dpa->id_dpa }}">Description:</label>
                            <textarea id="description-{{ $dpa->id_dpa }}" name="description" class="form-control" rows="5">{{ $dpa->description }}</textarea>
                        </div>
                        
                        <!-- Add a hidden input to store the selected Bendahara value -->
                        <input type="hidden" id="bendahara-value-{{ $dpa->id_dpa }}" name="bendahara" value="{{ $dpa->user_id4 }}">

                        <!-- Update the Bendahara dropdown -->
                        <div class="btn-group">
                            @if ($dpa->user_id4 && $dpa->bendaharaUsers)
                                {{ $dpa->bendaharaUsers->first_name }} {{ $dpa->bendaharaUsers->last_name }}
                            @else
                                <div class="dropdown">
                                    <button type="button" id="assign-btn-{{ $dpa->id_dpa }}" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                        Assign Bendahara
                                    </button>
                                    <div class="dropdown-menu">
                                        @foreach ($bendaharaUsers as $bendaharaUser)
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); assignBendahara({{ $dpa->id_dpa }}, {{ $bendaharaUser->id }}, '{{ $bendaharaUser->first_name }} {{ $bendaharaUser->last_name }}')">
                                                {{ $bendaharaUser->first_name }} {{ $bendaharaUser->last_name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</td>

<script>
function assignBendahara(dpaId, userId, userName) {
    // Update the hidden input with the selected user
    document.getElementById('bendahara-value-' + dpaId).value = userId;

    // Update the dropdown button text with the selected user's name
    document.getElementById('assign-btn-' + dpaId).textContent = userName;
}
</script>
@endif
@endhasrole

@hasrole('Bendahara')
<td>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descriptionModalPP-{{ $dpa->id_dpa }}">
Lihat Keterangan Disposisi
</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="descriptionModalPP-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog"
        aria-labelledby="descriptionModalPPLabel-{{ $dpa->id_dpa }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('updateDescription', ['dpaId' => $dpa->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="descriptionModalPPLabel-{{ $dpa->id_dpa }}">Edit Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description-{{ $dpa->id_dpa }}">Description:</label>
                            <textarea id="description-{{ $dpa->id_dpa }}" name="description" class="form-control" rows="5">{{ $dpa->description }}</textarea>
                        </div>
                        <!-- Add a hidden input to store the selected Bendahara value -->
                        <input type="hidden" id="bendahara-value-{{ $dpa->id_dpa }}" name="bendahara" value="{{ $dpa->user_id4 }}">

                        <!-- Update the Bendahara dropdown -->
                        <div class="form-group">
                            <label for="bendahara-{{ $dpa->id_dpa }}">Bendahara:</label>
                            @if ($dpa->user_id4 && $dpa->bendaharaUsers)
                            <input type="text" id="bendahara-{{ $dpa->id_dpa }}" class="form-control" value="{{ $dpa->bendaharaUsers->first_name }} {{ $dpa->bendaharaUsers->last_name }}" readonly>
                            @else
                            <select id="bendahara-{{ $dpa->id_dpa }}" class="form-control">
                            <option value="">Assign Bendahara</option>
                            @foreach ($bendaharaUsers as $bendaharaUser)
                            <option value="{{ $bendaharaUser->id }}">{{ $bendaharaUser->first_name }} {{ $bendaharaUser->last_name }}</option>
                            @endforeach
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</td>
@endhasrole

@hasrole('PPTK')
<td>
@if ($dpa->rup)
<div class="form-group">
    <label for="rup-display-{{ $dpa->id_dpa }}">RUP:</label>
    <input id="rup-display-{{ $dpa->id_dpa }}" class="form-control" value="{{ $dpa->rup }}" readonly>
</div>
@endif

<!-- Display the Nilai RUP value if it has a value -->
@if ($dpa->nilairup)
<div class="form-group">
    <label for="nilairup-display-{{ $dpa->id_dpa }}">Nilai RUP:</label>
    <input id="nilairup-display-{{ $dpa->id_dpa }}" class="form-control" value="{{ $dpa->nilairup }}" readonly>
</div>
@endif
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitFormRUP-{{ $dpa->id_dpa }}">
    Submit Form
</button>
    <div class="modal fade" id="submitFormRUP-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog"
        aria-labelledby="submitFormRUPLabel-{{ $dpa->id_dpa }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('submitRUP', ['dpaId' => $dpa->id]) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="submitFormRUPLabel-{{ $dpa->id_dpa }}">Submit RUP Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rup-{{ $dpa->id_dpa }}">RUP:</label>
                            <input id="rup-{{ $dpa->id_dpa }}" name="rup" class="form-control" value="{{ $dpa->rup }}">
                        </div>
                        <div class="form-group">
                            <label for="nilairup-{{ $dpa->id_dpa }}">Nilai RUP:</label>
                            <input id="nilairup-{{ $dpa->id_dpa }}" name="nilairup" class="form-control" value="{{ $dpa->nilairup }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</td>
<td>

    <!-- Dropdown form -->
    <form method="POST" action="{{ route('submitSumberDana', ['dpaId' => $dpa->id]) }}">
        @csrf
        <div class="form-group">
            <label for="sumber_dana-{{ $dpa->id }}">Sumber Dana:</label>
            <select id="sumber_dana-{{ $dpa->id }}" name="sumber_dana" class="form-control">
            <option value="DAU" {{ $dpa->sumber_dana == 'DAU' ? 'selected' : '' }}>DAU</option>
            <option value="PAD" {{ $dpa->sumber_dana == 'PAD' ? 'selected' : '' }}>PAD</option>
            <option value="DBH Pemerintah Provinsi" {{ $dpa->sumber_dana == 'DBH Pemerintah Provinsi' ? 'selected' : '' }}>DBH Pemerintah Provinsi</option>
            <option value="DBH Provinsi" {{ $dpa->sumber_dana == 'DBH Provinsi' ? 'selected' : '' }}>DBH Provinsi</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <form method="POST" action="{{ route('submitSumberDana', ['dpaId' => $dpa->id]) }}">
        @csrf
        <div class="form-group">
            <label for="other-{{ $dpa->id }}">Other:</label>
            <input type="text" id="other-{{ $dpa->id }}" name="other" class="form-control" value="{{ $dpa->sumber_dana }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</td>
@endhasrole

@hasrole(['Pembantu PPTK', 'PPTK', 'Bendahara'])
<td>
    <!-- Lihat Kelengkapan -->
    <div class="btn-group">
        <a href="{{ route('PembantuPPTKView.dokumenpembantupptk', ['dpaId' => $dpa->id]) }}"
            class="btn btn-info lihat-kelengkapan-btn">
            Lihat Kelengkapan
        </a>
            </div>
            </td>
            @endhasrole
            @php
            $isDpaAlreadyCreated = \App\Models\Ceklisform::where('dpa_id', $dpa->id)->exists();
            $spp = \App\Models\Bendahara::where('dpa_id', $dpa->id)->first();
            @endphp
            @hasrole('Bendahara')
            @if (!$isDpaAlreadyCreated)
            <!-- Check if DPA hasn't been created -->
            <td><a href="{{ route('ceklisform.index', ['id' => $dpa->id]) }}" class="btn btn-primary edit-btn">Ceklis</a></td>
            @else
            <td><a href="{{ route('ceklisform.result', ['id' => $dpa->id]) }}" class="btn btn-success">Lihat Hasil</a></td>
            @endif
            @endhasrole
            </tr>
            @endforeach
            </tbody>
            </table>
            {{-- {{ $dpaData->links() }} --}}
        </div>
    </div>
</div>
{{-- TOMBOL DETAIL --}}
@foreach ($dpaData as $dpa)
<!-- Detail Modal for DPA ID -->
<div class="modal fade" id="detailModal{{ $dpa->id }}" tabindex="-1" role="dialog"
    aria-labelledby="detailModalLabel{{ $dpa->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel{{ $dpa->id }}">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode Urusan</th>
                                <th>Urusan</th>
                                <th>Kode Bidang Urusan</th>
                                <th>Bidang Urusan</th>
                                <th>Kode SKPD</th>
                                <th>SKPD</th>
                                <th>Kode Sub SKPD</th>
                                <th>Sub SKPD</th>
                                <th>Kode Program</th>
                                <th>Program</th>
                                <th>Kode Kegiatan</th>
                                <th>Kegiatan</th>
                                <th>Kode Sub Kegiatan</th>
                                <th>Sub Kegiatan</th>
                                <th>Kode Akun</th>
                                <th>Nama Akun</th>
                                <th>Nilai Rincian</th>
                                <th>Total RAK</th>
                                <th>Tipe Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $dpa->id_dpa }}</td>
                                <td>{{ $dpa->kode_urusan }}</td>
                                <td>{{ $dpa->nama_urusan }}</td>
                                <td>{{ $dpa->kode_bidang_urusan }}</td>
                                <td>{{ $dpa->nama_bidang_urusan }}</td>
                                <td>{{ $dpa->kode_skpd }}</td>
                                <td>{{ $dpa->nama_skpd }}</td>
                                <td>{{ $dpa->kode_sub_skpd }}</td>
                                <td>{{ $dpa->nama_sub_skpd }}</td>
                                <td>{{ $dpa->kode_program }}</td>
                                <td>{{ $dpa->nama_program }}</td>
                                <td>{{ $dpa->kode_kegiatan }}</td>
                                <td>{{ $dpa->nama_kegiatan }}</td>
                                <td>{{ $dpa->kode_sub_kegiatan }}</td>
                                <td>{{ $dpa->nama_sub_kegiatan }}</td>
                                <td>{{ $dpa->kode_akun }}</td>
                                <td>{{ $dpa->nama_akun }}</td>
                                <td>Rp. {{ number_format($dpa->nilai_rincian, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($dpa->total_rak, 0, ',', '.') }}</td>
                                <td>{{ $dpa->tipe }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <!-- You can add more content to the timeline here -->
                <!-- Content to display detail information goes here -->
                <!-- You can use JavaScript or Blade template logic to populate this section -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- TOMBOL TRACKING --}}
<!-- Tracking Modal for DPA ID {{ $dpa->id }} -->
<div class="modal fade" id="trackingModal{{ $dpa->id }}" tabindex="-1" role="dialog"
    aria-labelledby="trackingModalLabel{{ $dpa->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trackingModalLabel{{ $dpa->id }}">Tracking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Progress Status:</h6>
                @if ($dpa->user_id4)
                <br><span class="badge badge-warning">Not Yet</span> Finish
                <br><span class="badge badge-info">In Progress</span> Dikerjakan Oleh Bendahara
                <br><span class="badge badge-success">Completed</span> Dikerjakan Oleh PPTK Dan Sudah Diverifikasi oleh
                Penjabat Pengadaan
                <br><span class="badge badge-success">Completed</span> Dikerjakan Oleh Penjabat Pengadaan
                <br><span class="badge badge-success">Completed</span> Dikerjakan Oleh PPTK
                <br><span class="badge badge-success">Has Assigned</span> Start
                @elseif ($dpa->user_id3)
                <br><span class="badge badge-warning">Not Assigned</span> Finish
                <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Bendahara
                <br><span class="badge badge-info">In Progress</span> Dikerjakan Oleh PPTK Dan Sudah Diverifikasi
                <br><span class="badge badge-success">Completed</span> Dikerjakan Oleh Penjabat Pengadaan
                <br><span class="badge badge-success">Completed</span> Dikerjakan Oleh PPTK
                <br><span class="badge badge-success">Has Assigned</span> Start
                @elseif ($dpa->user_id2)
                <br><span class="badge badge-warning">Not Assigned</span> Finish
                <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Bendahara
                <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh PPTK Dan Sudah Diverifikasi
                <br><span class="badge badge-info">In Progress</span> Dikerjakan Oleh Penjabat Pengadaan
                <br><span class="badge badge-success">Completed</span> Dikerjakan Oleh PPTK
                <br><span class="badge badge-success">Has Assigned</span> Start
                @elseif ($dpa->user_id)
                <br><span class="badge badge-warning text-warning">Not Assigned</span> Finish
                <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Bendahara
                <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh PPTK Dan Sudah Diverifikasi
                <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Penjabat Pengadaan
                <br><span class="badge badge-info">In Progress</span> Dikerjakan Oleh PPTK
                <br><span class="badge badge-success">Has Assigned</span> Start
                @else
                {{-- <div style="border-left: 16px solid purple"> --}}
                    <br><span class="badge badge-warning text-warning">Not Assigned</span> Finish
                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Bendahara
                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh PPTK Dan Sudah
                    Diverifikasi
                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Penjabat Pengadaan
                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Penjabat Pengadaan
                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh PPTK
                    <br><span class="badge badge-warning text-warning">Not Assigned</span> Start
                    @endif
                    <!-- Content to display tracking information goes here -->
                    <!-- You can use JavaScript or Blade template logic to populate this section -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>

{{--
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}"></script> --}}
@if(isset($dpa))
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.row-clickable');
    rows.forEach(row => {
        row.addEventListener('click', function (event) {
            const dpaId = row.getAttribute('data-dpa-id');
            const assignBtn = row.querySelector('.assign-btn');

            if (event.target.classList.contains('assign-btn')) {
                if (assignBtn.classList.contains('assigned')) {
                    // Handle Pejabat Pengadaan button click
                    const assignedName = row.querySelector('.assigned-name');
                    const userFullName = assignedName.textContent.trim();
                    alert(`Assigned Pejabat Pengadaan: ${userFullName}`);
                } else {
                    // Handle PPTK button click
                    const userLink = assignBtn.nextElementSibling.querySelector('.assign-user-link');
                    const userId = getUserIdFromLink(userLink.getAttribute('href'));
                    alert(`Assigned PPTK: UserID - ${userId}`);
                }
            } else {
                // Handle row click to navigate to the DPA detail page
                //window.location.href = `{{ route('PembantuPPTKView.dokumenpembantupptk', ['dpaId' => ':dpaId']) }}`.replace(':dpaId', dpaId);
            }
        });
    });
        // Prevent click event propagation for Edit and View PDF buttons
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });

        const viewPdfButtons = document.querySelectorAll('.view-pdf-btn');
        viewPdfButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });      
    });

    function deleteDpa(deleteUrl) {
    const confirmation = confirm('Are you sure you want to delete this item?');
    if (confirmation) {
        const form = document.createElement('form');
        form.method = 'POST'; // Use POST method to avoid the "GET method not supported" error
        form.action = deleteUrl;
        form.style.display = 'none';

        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}'; // Replace with your actual token value

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';

        form.appendChild(csrfInput);
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
    }

}
</script>
@else
    <!-- Print a message or choose an alternative behavior when $dpa doesn't exist -->
    <p>No DPA available.</p>
@endif

@endsection
<style>
    .hide-underscore {
        text-decoration: underline;
        /* Apply underline to text */
        color: transparent;
        /* Make text color transparent (hides underscores) */
    }

    .custom-table {
        border: 1px solid #000 !important;
        /* Set the border color to black (#000) with !important */
        border-collapse: collapse;
        /* Collapse borders into a single line */
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
        border-color: #000 !important;
        /* Set the border color to black (#000) with !important */
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