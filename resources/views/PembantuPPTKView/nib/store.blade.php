@extends('layouts.app')

@section('title', 'NIB - Success')

@section('content')
<div class="container-fluid">
    <div class="alert alert-success">
        <h4 class="alert-heading">Success!</h4>
        <p>NIB has been successfully submitted and saved.</p>
    </div>
    <a href="{{ route('PembantuPPTKView.nib.create') }}" class="btn btn-primary">Back to Form</a>
</div>
@endsection
