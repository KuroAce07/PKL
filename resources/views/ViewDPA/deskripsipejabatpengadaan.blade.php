@extends('layouts.app')

@section('title', 'DPA Description')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">DPA Description</div>

                <div class="card-body">
                    <p>Nomor DPA: {{ $dpa->kode_sub_kegiatan }}</p>
                    
                    <form method="POST" action="{{ route('updateDescriptionPP', ['dpaId' => $dpa->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="descriptionPP">Description:</label>
                            <textarea id="descriptionPP" name="descriptionPP" class="form-control" rows="5">{{ $dpa->descriptionPP }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-2">Save Description</button>
                        <a href="{{ route('ViewDPA.index') }}" class="btn btn-secondary mt-2">Back to DPAs</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
