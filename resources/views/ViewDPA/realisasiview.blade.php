{{-- Comparasion SECTION --}}
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rencana Anggaran Kas</h1>
    </div>

    @include('common.alert')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Realisasi Anggaran Kas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>