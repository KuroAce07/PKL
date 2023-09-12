Assign Pejabat Pengadaan
</button>
<div class="dropdown-menu">
@foreach ($pejabatPengadaanUsers as $pejabatPengadaanUser)
<a class="dropdown-item" href="{{ route('ViewDPA.assignPP', ['dpaId' => $dpa->id, 'userId' => $pejabatPengadaanUser->id]) }}">
{{ $pejabatPengadaanUser->first_name }} {{ $pejabatPengadaanUser->last_name }}
</a>
@endforeach
</div>
@endif
</div>
<div class="btn-group d-flex justify-content-center mt-4">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descriptionModal-{{ $dpa->id_dpa }}">
Lihat Description
</button>
</div>
<!-- Modal -->
<div class="modal fade" id="descriptionModal-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel-{{ $dpa->id_dpa }}" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<form method="POST" action="{{ route('updateDescriptionPP', ['dpaId' => $dpa->id]) }}">
@csrf
@method('PUT')
<div class="modal-header">
<h5 class="modal-title" id="descriptionModalLabel-{{ $dpa->id_dpa }}">Edit Description</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<div class="form-group">
<label for="descriptionPP-{{ $dpa->id_dpa }}">Description:</label>
<textarea id="descriptionPP-{{ $dpa->id_dpa }}" name="descriptionPP" class="form-control" rows="5">{{ $dpa->descriptionPP }}</textarea>
</div>

<!-- Add a hidden input to store the selected Pejabat Pengadaan value -->
<input type = "hidden" id ="pp-value-{{ $dpa->id_dpa }}" name ="pp" value ="{{ $dpa->user_id2 }}">

<!-- Update the Pejabat Pengadaan dropdown -->
<div class = "form-group">
<label for ="pp-{{ $dpa->id_dpa }}">Pejabat Pengadaan:</label>
@if ($dpa->user_id2 && $dpa->pejabatPengadaanUser)
<input type = "text" id ="pp-{{ $dpa->id_dpa }}" class ="form-control" value ="{{ $dpa->pejabatPengadaanUser->first_name }} {{ $dpa->pejabatPengadaanUser->last_name }}" readonly>
@else
<select id ="pp-{{ $dpa->id_dpa }}" class ="form-control">
<option value = "">Assign Pejabat Pengadaan</option>
@foreach ($pejabatPengadaanUsers as $pejabatPengadaanUser)
<option value="{{ $pejabatPengadaanUser->id }}">{{ $pejabatPengadaanUser->first_name }} {{ $pejabatPengadaanUser->last_name }}</option>
@endforeach
</select>
@endif
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

change this one too:                                     <!-- Assign Pejabat pengadaan -->
                                    <div class="btn-group">
                                        @if ($dpa->user_id2 && $dpa->pejabatPengadaanUser)
                                            {{ $dpa->pejabatPengadaanUser->first_name }} {{ $dpa->pejabatPengadaanUser->last_name }}
                                        @else
                                            <button type="button" class="btn btn-secondary dropdown-toggle assign-btn" data-toggle="dropdown">
                                                Assign Pejabat Pengadaan
                                            </button>
                                            <div class="dropdown-menu">
                                                @foreach ($pejabatPengadaanUsers as $pejabatPengadaanUser)
                                                    <a class="dropdown-item" href="{{ route('ViewDPA.assignPP', ['dpaId' => $dpa->id, 'userId' => $pejabatPengadaanUser->id]) }}">
                                                        {{ $pejabatPengadaanUser->first_name }} {{ $pejabatPengadaanUser->last_name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="btn-group d-flex justify-content-center mt-4">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#descriptionModal-{{ $dpa->id_dpa }}">
        Lihat Description
    </button>
</div>
<!-- Modal -->
<div class="modal fade" id="descriptionModal-{{ $dpa->id_dpa }}" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel-{{ $dpa->id_dpa }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('updateDescriptionPP', ['dpaId' => $dpa->id]) }}">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel-{{ $dpa->id_dpa }}">Edit Description</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descriptionPP-{{ $dpa->id_dpa }}">Description:</label>
                        <textarea id="descriptionPP-{{ $dpa->id_dpa }}" name="descriptionPP" class="form-control" rows="5">{{ $dpa->descriptionPP }}</textarea>
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
