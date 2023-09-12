@extends('layouts.app')

@section('content')
    @if(!empty($tableData))
        <h1>Table Data</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Keyword</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tableData as $keyword => $data)
                        <tr>
                            <td>{{ $keyword }}</td>
                            <td>{{ $data }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No table data found.</div>
    @endif
@endsection