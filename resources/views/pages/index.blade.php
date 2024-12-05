@extends('layouts.master')
@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
    {{-- table --}}
    @livewire('crud.table-list')
@endsection
