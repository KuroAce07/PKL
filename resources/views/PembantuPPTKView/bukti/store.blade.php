@extends('layouts.app')

@section('title', 'Nota/Bukti Pembelian/Invoice - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Nota/Bukti Pembelian/Invoice has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.bukti.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
