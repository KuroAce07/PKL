@extends('layouts.app')

@section('title', 'Arsip List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dokumen Keuangan</h1>
            <div class="row">
                <div>
                    <a href="{{ route('Arsip.export') }}" class="btn btn-success ml-auto">Export to Excel</a>
                </div>
            </div>
        </div>
        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Semua Dokumen</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kegiatan</th>
                                <th>Sub Kegiatan</th>
                                <th>Uraian Belanja</th>
                                <th>Sumber Dana</th>
                                <th>No SPM</th>
                                <th>Tanggal SPM</th>
                                <th>Nilai SPM</th>
                                <th>Terbilang</th>
                                <th>PPH 21</th>
                                <th>PPH 22</th>
                                <th>PPH 23</th>
                                <th>PPN</th>
                                <th>PPND</th>
                                <th>Lain Lain</th>
                                <th>Tanggal SP2D</th>
                                <th>No SP2D</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arsipList as $arsip)
                                <tr>
                                    <td>{{ $arsip->id }}</td>
                                    <td>{{ $arsip->nama }}</td>
                                    <td>{{ $arsip->nama_sub_kegiatan }}</td>
                                    <td>{{ $arsip->sub_kegiatan }}</td>
                                    <td>{{ $arsip->uraian_belanja }}</td>
                                    <td>{{ $arsip->sumber_dana }}</td>
                                    <td>{{ $arsip->no_spm }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $arsip->tanggal_spm)->formatLocalized('%d %B %Y') }}</td>
                                    <td>Rp. {{ number_format($arsip->nilai_spm, 2, ',', '.') }}</td>
                                    <td>{{ numberToWordsIDR($arsip->nilai_spm) }} rupiah</td>
                                    <td>{{ number_format(intval($arsip->pph_21), 0, ',', '.') }}</td>
                                    <td>{{ number_format(intval($arsip->pph_22), 0, ',', '.') }}</td>
                                    <td>{{ number_format(intval($arsip->pph_23), 0, ',', '.') }}</td>
                                    <td>{{ number_format(intval($arsip->ppn), 0, ',', '.') }}</td>
                                    <td>{{ number_format(intval($arsip->ppnd), 0, ',', '.') }}</td>
                                    <td>{{ number_format(intval($arsip->lain_lain), 0, ',', '.') }}</td>
                                    <td>{{ $arsip->tanggal_sp2d }}</td>
                                    <td>{{ $arsip->no_sp2d }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('Arsip.edit', $arsip->id) }}" class="btn btn-primary mr-2">
                                                <i class="fa fa-pen"></i> Edit
                                            </a>
                                            <form action="{{ route('Arsip.destroy', $arsip->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                            <a href="{{ route('Arsip.file', $arsip->id) }}" class="btn btn-success mr-2"> <!-- Use btn-success for a green color -->
                                                <i class="fa fa-eye"></i> Lihat File <!-- Change the icon to an eye icon for "View File" -->
                                            </a>
                                        </div>                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $arsipList->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <!-- Add any required scripts here -->
@endsection