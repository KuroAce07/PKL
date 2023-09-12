@extends('layouts.app')

@section('title', 'E-Purchasing - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>Your E-Purchasing data has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.epurchaseview.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
