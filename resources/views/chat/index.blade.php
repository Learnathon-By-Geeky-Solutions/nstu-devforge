@extends('layouts.back')
@section('title', 'Message')
@section('content')

    <!--begin::App Content-->
    <div class="app-content mt-3">
        <!--begin::Container-->
        <div class="container-fluid">

            <iframe src="/message/{{ $driver }}" style="width: 100%; height: 80vh; border: none;"></iframe>
        </div>
         <!--end::Container-->
    </div>
    <!--end::App Content-->
 @endsection
