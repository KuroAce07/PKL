@extends('layouts.app')

@section('title', 'Sub DPA Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sub Kegiatan DPA</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
    @php
        $totalJASKSum = 0; // Initialize the sum of all JASK values
    @endphp
    <!-- Display Sub Kegiatan -->
    @foreach ($dpa->subDPA as $index => $sub_dpa)
        @php
            $subkegiatan = $sub_dpa->sub_kegiatan;
            $kodeRekeningLines = explode("\n", $sub_dpa->kode_rekening);
            $uraianLines = explode("\n", $sub_dpa->uraian);
            $koefisienLines = explode("\n", $sub_dpa->koefisien);
            $satuanLines = explode("\n", $sub_dpa->satuan);
            $hargaLines = explode("\n", $sub_dpa->harga);
            $jumlahLines = explode("\n", $sub_dpa->jumlah);
            $sumberDana = $sub_dpa->sumber_dana;
            $jenisbarang = $sub_dpa->jenis_barang;
            $JASK = $sub_dpa->jumlah_anggaran_sub_kegiatan;
            $maxRows = max(count($kodeRekeningLines), count($uraianLines), count($koefisienLines), count($satuanLines), count($hargaLines), count($jumlahLines));
            $jaskNumericValue = (int) preg_replace('/[^0-9]/', '', $JASK);
            $totalJASKSum += $jaskNumericValue;
        @endphp
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sub Kegiatan : {{ $subkegiatan }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Rekening</th>
                                <th>Uraian</th>
                                <th>Koefisien</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>PPN</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Loop through rows for the current subDPA -->
                            @for ($rowIndex = 0; $rowIndex < $maxRows; $rowIndex++)
                                <tr>
                                    <td>
                                    @if ($rowIndex === 5)
                                    @elseif ($rowIndex === 6)
                                    @elseif ($rowIndex === 7)
                                    @php
                                    $kr = 5
                                    @endphp
                                    {{ $kodeRekeningLines[$kr] ?? '' }}
                                    @elseif ($rowIndex === 8)
                                    @php
                                    $kr = 6
                                    @endphp
                                    {{ $kodeRekeningLines[$kr] ?? '' }}
                                    @elseif ($rowIndex === 9)
                                    @php
                                    $kr = 7
                                    @endphp
                                    {{ $kodeRekeningLines[$kr] ?? '' }}
                                    @else
                                    {{ $kodeRekeningLines[$rowIndex] ?? '' }}</td>
                                    @endif
                                    
                                    <td>
                                        @if ($rowIndex === (count($jumlahLines) - 1) && $rowIndex < 8)
                                        {{ $sumberDana }}
                                        @elseif ($rowIndex === 5)
                                        {{ substr($sumberDana, 0, strpos($sumberDana, '[#]')) }}
                                        @elseif ($rowIndex === 6)
                                        @php
                                        $startPos = strpos($jenisbarang, 'Fotocopy F4/A4 70 Gram');
                                        $endPos = strpos($jenisbarang, 'FotoCopySpesifikasi ', $startPos);
                                        if ($startPos !== false && $endPos !== false) {
                                            $extractedText = substr($jenisbarang, $startPos, $endPos - $startPos);
                                        } else {
                                            $extractedText = $jenisbarang;
                                        }
                                    @endphp

                                    {{ $extractedText }}
                                        @elseif ($rowIndex === 10 && strpos($sumberDana, '[#]') !== false)
                                        {{ substr($sumberDana, strpos($sumberDana, '[#]') + 4) }}
                                        @elseif ($rowIndex === 11)
                                        @php
                                        $jenisbarang = $sub_dpa->jenis_barang;

                                        // Find the position of the first occurrence of "FotoCopySpesifikasi"
                                        $startPos = strpos($jenisbarang, 'FotoCopySpesifikasi');

                                        if ($startPos !== false) {
                                            // Find the position of the second occurrence of "Spesifikasi :" starting from the first occurrence of "FotoCopySpesifikasi"
                                            $endPos = strpos($jenisbarang, 'Spesifikasi :', $startPos + 1);

                                            if ($endPos === false) {
                                                // If there's no second occurrence, extract text from the first occurrence to the end
                                                $extractedText = substr($jenisbarang, $startPos + strlen('FotoCopySpesifikasi'));
                                            } else {
                                                // Extract text between the first occurrence of "FotoCopySpesifikasi" and the second occurrence of "Spesifikasi :"
                                                $extractedText = substr($jenisbarang, $startPos + strlen('FotoCopySpesifikasi'), $endPos - ($startPos + strlen('FotoCopySpesifikasi')));
                                            }

                                            // Remove leading and trailing spaces and colons
                                            $extractedText = trim($extractedText, " :");

                                            // Remove any trailing text after "Spesifikasi :"
                                            $endSpesifikasiPos = strpos($extractedText, 'Spesifikasi :');
                                            if ($endSpesifikasiPos !== false) {
                                                $extractedText = substr($extractedText, 0, $endSpesifikasiPos);
                                            }
                                        } else {
                                            $extractedText = '';
                                        }
                                    @endphp

                                    {{ $extractedText }}

                                        @elseif ($rowIndex === 12)
                                        @php
                                        $jenisbarang = $sub_dpa->jenis_barang;

                                        // Find the position of "Uang Harian"
                                        $startPos = strpos($jenisbarang, 'Uang Harian');

                                        if ($startPos !== false) {
                                            // Extract text from "Uang Harian" to the end
                                            $extractedText = substr($jenisbarang, $startPos);

                                            // Remove any leading or trailing spaces and colons
                                            $extractedText = trim($extractedText, " :");
                                        } else {
                                            $extractedText = '';
                                        }
                                    @endphp
                                    {{ $extractedText }}

                                    @elseif ($rowIndex === 7)
                                    @php
                                    $kr = 5
                                    @endphp
                                    {!! $uraianLines[$kr] ?? '' !!}
                                    @elseif ($rowIndex === 8)
                                    @php
                                    $kr = 6
                                    @endphp
                                    {!! $uraianLines[$kr] ?? '' !!}
                                    @elseif ($rowIndex === 9)
                                    @php
                                    $kr = 7
                                    @endphp
                                    {!! $uraianLines[$kr] ?? '' !!}
                                    @else
                                    {!! $uraianLines[$rowIndex] ?? '' !!}
                                    @endif
                                    </td>
                                    <td>
                                    @if ($rowIndex === 6)
                                    @php
                                    $koefisien = $sub_dpa->koefisien;

                                    // Split the content by line breaks
                                    $lines = explode("\n", $koefisien);

                                    // Get the first line
                                    $firstLine = trim($lines[0]); // Remove leading and trailing spaces

                                    // Remove any leading or trailing spaces and colons
                                    $extractedText = trim($firstLine, " :");
                                @endphp

                                {{ $extractedText }}

                                    @elseif($rowIndex === 11)
                                    @php
    $koefisien = $sub_dpa->koefisien;

    // Split the content by line breaks
    $lines = explode("\n", $koefisien);

    // Check if there is a second line
    if (isset($lines[1])) {
        $secondLine = trim($lines[1]); // Remove leading and trailing spaces

        // Remove any leading or trailing spaces and colons
        $extractedText = trim($secondLine, " :");
    } else {
        $extractedText = '';
    }
@endphp

{{ $extractedText }}

                                    @elseif($rowIndex === 12)
                                    @php
                                    $koefisien = $sub_dpa->koefisien;

                                    // Split the content by line breaks
                                    $lines = explode("\n", $koefisien);

                                    // Check if there is a third line
                                    if (isset($lines[2])) {
                                        $thirdLine = trim($lines[2]); // Remove leading and trailing spaces

                                        // Remove any leading or trailing spaces and colons
                                        $extractedText = trim($thirdLine, " :");
                                    } else {
                                        $extractedText = '';
                                    }
                                @endphp

                                {{ $extractedText }}

                                    @endif
                                    </td>
                                    <td>
                                    @if ($rowIndex === 6)
                                    @php
                                    $satuan = $sub_dpa->satuan;
                                    // Split the content by line breaks
                                    $lines = explode("\n", $satuan);

                                    // Check if there is a third line
                                    if (isset($lines[0])) {
                                        $line = trim($lines[0]); // Remove leading and trailing spaces

                                        // Remove any leading or trailing spaces and colons
                                        $extractedText = trim($line, " :");
                                    } else {
                                        $extractedText = '';
                                    }
                                @endphp
                                {{ $extractedText }}
                                    @elseif($rowIndex === 11)
                                    @php
                                    $satuan = $sub_dpa->satuan;
                                    // Split the content by line breaks
                                    $lines = explode("\n", $satuan);

                                    // Check if there is a third line
                                    if (isset($lines[1])) {
                                        $line = trim($lines[1]); // Remove leading and trailing spaces

                                        // Remove any leading or trailing spaces and colons
                                        $extractedText = trim($line, " :");
                                    } else {
                                        $extractedText = '';
                                    }
                                @endphp
                                {{ $extractedText }}
                                    @elseif($rowIndex === 12)
                                    @php
                                    $satuan = $sub_dpa->satuan;
                                    // Split the content by line breaks
                                    $lines = explode("\n", $satuan);

                                    // Check if there is a third line
                                    if (isset($lines[2])) {
                                        $line = trim($lines[2]); // Remove leading and trailing spaces

                                        // Remove any leading or trailing spaces and colons
                                        $extractedText = trim($line, " :");
                                    } else {
                                        $extractedText = '';
                                    }
                                @endphp
                                {{ $extractedText }}
                                    @endif
                                    </td>
                                    <td> 
                                    @if ($rowIndex === 6)
                                    @php
                                    $harga = $sub_dpa->harga;
                                    // Convert the integer to a string
                                    $hargaString = (string) $harga;
                                    // Extract the first 3 characters
                                    $firstThreeDigits = substr($hargaString, 0, 3);
                                    // Convert the extracted string back to an integer
                                    $extractedNumber = (int) $firstThreeDigits;
                                @endphp
                                {{ $extractedNumber }}
                                    @elseif($rowIndex === 11)
                                    @php
                                        $harga = $sub_dpa->harga;
                                        // Convert the integer to a string
                                        $hargaString = (string) $harga;
                                        // Extract the characters from positions 3 to 5 (0-based indexing)
                                        $extractedDigits = substr($hargaString, 3, 3);
                                        // Convert the extracted string to an integer if needed
                                        $extractedNumber = (int) $extractedDigits;
                                    @endphp
                                    {{ $extractedNumber }}.000
                                    @elseif($rowIndex === 12)
                                    @php
                                    $harga = $sub_dpa->harga;
                                    // Convert the integer to a string
                                    $hargaString = (string) $harga;
                                    // Extract the characters from positions 6 to 8 (0-based indexing)
                                    $extractedDigits = substr($hargaString, 6, 3);
                                    // Convert the extracted string to an integer if needed
                                    $extractedNumber = (int) $extractedDigits;
                                @endphp
                                {{ $extractedNumber }}.000
                                    @endif
                                    </td>
                                    <td></td>
                                    <td>{{ $jumlahLines[$rowIndex] ?? '' }}</td>
                                </tr>
                            @endfor

                            <!-- Add a new row for jenis_barang -->
                            @if($maxRows>8)
                            @else
                            <tr>
                                <td></td>
                                <td>{!! preg_replace('/\s*Spesifikasi\s*:\s*/i', '<br>Spesifikasi: ', $jenisbarang) !!}</td>
                                <td>{{ $koefisienLines[count($koefisienLines) - 1] ?? '' }}</td>
                                <td>{{ $satuanLines[count($satuanLines) - 1] ?? '' }}</td>
                                <td>{{ $hargaLines[count($hargaLines) - 1] ?? '' }}</td>
                                <td>0</td>
                                <td>{{ $jumlahLines[count($jumlahLines) - 1] ?? '' }}</td>
                            </tr>
                            @endif
                        <tr>
                        <td></td>
                        <td>Jumlah Anggaran Sub Kegiatan</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $JASK }}</td>
                    </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Total Jumlah Anggaran</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Total Jumlah Anggaran Sub Kegiatan :</h5>
                <h4 class="text-primary">Rp{{ number_format($totalJASKSum, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>    
</div>
@endsection