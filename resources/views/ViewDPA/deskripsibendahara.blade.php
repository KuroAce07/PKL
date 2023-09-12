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
                    
                    <form method="POST" action="{{ route('updateDescription', ['dpaId' => $dpa->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control" rows="5">{{ $dpa->description }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-2">Save Description</button>
                    </form>

                    <!-- Add additional details or formatting as needed -->

                    <a href="{{ route('ViewDPA.index') }}" class="btn btn-secondary mt-2">Back to DPAs</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
