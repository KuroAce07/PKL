@extends('layouts.app')

@section('title', 'DPA Tracking')

@section('content')
<!-- Add these lines to your HTML head section -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tracking DPA</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DAFTAR DPA</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor DPA</th>
                            <th>Sub Kegiatan</th>
                            <th>Akun</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dpaData as $dpa)
                            <tr>
                                <td>{{ $dpa->id }}</td>
                                <td>{{ $dpa->kode_sub_kegiatan }} {{ $dpa->nama_sub_kegiatan }}</td>
                                <td>{{ $dpa->kode_akun }} {{ $dpa->nama_akun }}</td>
                                <td>
                                    <button class="cek-progress-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#timeline-popup-{{ $dpa->id }}">Cek Progress</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- <div id="my-roadmap"></div> --}}

@foreach ($dpaData as $dpa)
                    <!-- Modal for Timeline Progress -->
                    <div class="modal fade" id="timeline-popup-{{ $dpa->id }}" tabindex="-1" aria-labelledby="timeline-popup-label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="timeline-popup-label">Timeline Progress</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6>Progress Status:</h6>
                                    @if ($dpa->user_id4)
                                    <br><span class="badge badge-warning">Not Yet</span> Finish
                                    <span class="badge badge-info">In Progress</span> Dikerjakan Oleh Bendahara
                                    <span class="badge badge-success">Completed</span> Dikerjakan Oleh PPTK Dan Sudah Diverifikasi oleh Penjabat Pengadaan
                                    <span class="badge badge-success">Completed</span> Dikerjakan Oleh Penjabat Pengadaan
                                    <span class="badge badge-success">Completed</span> Dikerjakan Oleh PPTK
                                    <span class="badge badge-success">Completed</span> Start
                                    @elseif ($dpa->user_id3)
                                    <br><span class="badge badge-warning">Not Assigned</span> Finish
                                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Bendahara
                                    <br><span class="badge badge-info">In Progress</span> Dikerjakan Oleh PPTK Dan Sudah Diverifikasi
                                    <br><span class="badge badge-success">Completed</span> Dikerjakan Oleh Penjabat Pengadaan
                                    <br><span class="badge badge-success">Completed</span> Dikerjakan Oleh PPTK
                                    <br><span class="badge badge-success">Completed</span> Start
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
                                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh PPTK Dan Sudah Diverifikasi
                                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Penjabat Pengadaan
                                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh Penjabat Pengadaan
                                    <br><span class="badge badge-warning">Not Assigned</span> Dikerjakan Oleh PPTK
                                    <br><span class="badge badge-warning text-warning">Not Assigned</span> Start
                                    @endif
                                    <!-- You can add more content to the timeline here -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-4">
                    {{ $dpaData->links() }}
                </div>
                <style>
                    .timeline {
                        display: flex;
                        flex-direction: row;
                        overflow-x: auto;
                    }
                
                    .timeline-entry {
                        display: flex;
                        align-items: center;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        padding: 10px;
                        margin-right: 10px;
                        cursor: pointer;
                    }
                
                    .timeline-indicator {
                        width: 10px;
                        height: 10px;
                        border-radius: 50%;
                        margin-right: 10px;
                    }
                
                    .bg-success {
                        background-color: #28a745;
                    }
                
                    .bg-danger {
                        background-color: #dc3545;
                    }
                </style>

<script>
    // Optional: Close the modal when the Escape key is pressed
    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            const openModal = document.querySelector('.modal.show');
            if (openModal) {
                const modal = bootstrap.Modal.getInstance(openModal);
                modal.hide();
            }
        }
    });
</script>
@endsection
