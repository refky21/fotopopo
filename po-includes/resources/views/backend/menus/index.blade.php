@extends('layouts.app')
@section('title', __('menumanager.datatable_title'))

@section('content')
    {!! Menu::render() !!}
@endsection

@push('scripts')
    {!! Menu::scripts() !!}
@endpush
