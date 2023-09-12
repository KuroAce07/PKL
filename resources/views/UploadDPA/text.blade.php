@extends('layouts.app')

@section('content')
    <h1>Extracted Text</h1>
    <div class="alert alert-success">
        {{ $pdfText }}
    </div>
@endsection
