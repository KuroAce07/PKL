@extends('layouts.app')

@section('content')
    <h2>Daftar File dalam Folder {{ $folderName }}</h2>
    <ul>
        @foreach ($files as $file)
            <li><a href="{{ asset('uploads/' . $folderName . '/' . $file) }}" target="_blank">{{ $file }}</a></li>
        @endforeach
    </ul>
@endsection
