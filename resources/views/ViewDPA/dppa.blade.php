@extends('layouts.app')

@section('title', 'View DPA')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View DPA</h1>
    </div>

    @include('common.alert')

    @if (count($combinedData) > 0)
        @foreach ($combinedData as $index => $data)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">DPPA Data and Matching Rows</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-primary">Tabel DPPA</h6>
                            <table class="inner-table">
                                @foreach ($data['dppaRow']->getAttributes() as $key => $value)
                                    @if (!in_array($key, ['user_id', 'user_id2', 'user_id3', 'user_id4', 'rekanan_id', 'daerah']))
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="font-weight-bold text-primary">Tabel DPA</h6>
                            <table class="inner-table">
                                @foreach ($data['matchingRow']->getAttributes() as $key => $value)
                                    @if (!in_array($key, ['user_id', 'user_id2', 'user_id3', 'user_id4', 'rekanan_id', 'daerah']))
                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No DPPA data available.</p>
    @endif
</div>
@endsection

<style>
    .inner-table {
        border-collapse: collapse;
        width: 100%;
    }

    .inner-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
</style>
