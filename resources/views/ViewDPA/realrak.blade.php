@extends('layouts.app')

@section('title', 'Realisasi RAK')

@section('content')

{{-- Realisasi --}}
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Realisasi Rencana Anggaran Kas</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Realisasi Rencana Anggaran Kas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Realisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $hasRealisasi = false;
                            $totalRealisasi = 0; // Initialize total_rak
                        @endphp

                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $bulanValue = "bulan_$i";
                                $realisasiValue = $realisasi->$bulanValue ?? null;
                                $formattedValue = number_format($realisasiValue, 0, ',', '.');
                            @endphp
                            @if ($realisasiValue !== null)
                                <tr>
                                    <td>Bulan {{ $i }}</td>
                                    <td>Rp. {{ $formattedValue }}</td>
                                </tr>
                                @php
                                    $hasRealisasi = true;
                                    // Add the realisasi value to total_rak
                                    $totalRealisasi += $realisasiValue;
                                @endphp
                            @endif
                        @endfor

                        @if ($hasRealisasi)
                            <tr>
                                <td>Total Realisasi RAK</td>
                                <td>Rp. {{ number_format($totalRealisasi, 0, ',', '.') }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="2">Belum Ada Realisasi</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            {{-- SECOND SECTION --}}
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Realisasi RAK</h1>
            </div>

            @include('common.alert')

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Realisasi Rencana Anggaran Kas</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('ViewDPA.updateRealisasi', $dpa->id) }}" method="POST">

                        @csrf
                        @method('PUT')
                        <input type="hidden" name="dpa_id" value="{{ $dpa->id }}">
                        <input type="hidden" name="total_rak" value="{{ $totalRealisasi }}"> <!-- Add this line -->
                    
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $bulanValue = "bulan_$i";
                                // $formattedValue = number_format($dpa->$bulanValue);
                            @endphp
                            <div class="form-group">
                                <label for="bulan_{{ $i }}">Bulan {{ $i }}</label>
                                <input type="text" class="form-control" id="bulan_{{ $i }}" name="bulan_{{ $i }}"
                                       value="{{ old('bulan_' . $i, $realisasi->$bulanValue ?? '') }}">
                            </div>
                        @endfor
                    
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            {{-- FIRST SECTION --}}
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Rencana Anggaran Kas</h1>
            </div>

            @include('common.alert')

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Rencana Anggaran Kas</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Nomor</th>
                                <td>{{ $dpa->id }}</td>
                            </tr>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <td>{{ $dpa->nama_kegiatan }}</td>
                            </tr>
                            <tr>
                                <th>Sub Kegiatan</th>
                                <td>{{ $dpa->nama_sub_kegiatan }}</td>
                            </tr>
                            <tr>
                                <th>Nama Akun</th>
                                <td>{{ $dpa->nama_akun }}</td>
                            </tr>
                            @for ($i = 1; $i <= 12; $i++)
                                @php
                                    $bulanValue = "bulan_$i";
                                    $formattedValue = number_format($dpa->$bulanValue, 0, ',', '.');
                                @endphp
                                @if ($dpa->$bulanValue != 0)
                                    <tr>
                                        <th>Bulan {{ $i }}</th>
                                        <td>Rp. {{ $formattedValue }}</td>
                                    </tr>
                                @endif
                            @endfor
                            <tr>
                                <th>Total RAK</th>
                                <td>Rp. {{ number_format($dpa->total_rak, 0, ',', '.') }}</td>
                            </tr>
                            
                            <!-- Add more rows for the first section as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
