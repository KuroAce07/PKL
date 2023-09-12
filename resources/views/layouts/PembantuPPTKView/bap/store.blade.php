@extends('layouts.app')

@section('title', 'Berita Acara Pembayaran (BAP) - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your Berita Acara Pembayaran (BAP) has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.bap.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
