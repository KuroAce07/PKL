@extends('layouts.app')

@section('title', 'NPWP - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>NPWP has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.npwp.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
