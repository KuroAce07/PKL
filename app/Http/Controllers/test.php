@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Pop Up View</div>
        <div class="card-body">
          <form method="POST" action="{{ route('submit') }}">
            @csrf
            <div class="form-group">
              <label for="rup">RUP</label>
              <input type="text" class="form-control" id="rup" name="rup" required>
            </div>
            <div class="form-group">
              <label for="nilairup">Nilai RUP</label>
              <input type="number" class="form-control" id="nilairup" name="nilairup" required>
            </div>
            <div class="btn-group d-flex justify-content-center mt-4">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitRUP">
                Lihat Description
              </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="submitRUP" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabelRUP" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form method="POST" action="{{ route('updateDescriptionRUP', ['dpaId' => $dpa->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="descriptionModalLabelRUP">Edit Description</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="descriptionRUP">Description:</label>
                        <textarea id="descriptionRUP" name="descriptionRUP" class="form-control" rows="5">{{ $dpa->descriptionRUP }}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Save changes</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection