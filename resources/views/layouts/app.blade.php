@extends('adminlte::page')
@push('css')
    {{-- adminlte --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    {{-- jquery ui --}}
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/2f9ed4fc87.js" crossorigin="anonymous"></script>
@endpush
@push('js')
    {{-- adminlte --}}
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
    {{-- datatable --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    {{-- sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- jquery ui --}}
    {{-- jquery 會衝突 --}}
    {{-- <script src="{{ asset('js/jquery ui/external/jquery/jquery.js') }}"></script>--}}
    <script src="{{ asset('js/jquery ui/jquery-ui.min.js') }}"></script>
    {{-- moment.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" referrerpolicy="no-referrer"></script>
@endpush
