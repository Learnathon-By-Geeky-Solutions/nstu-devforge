@extends('layouts.back')
@section('title', 'Add New Vehicle')
@push('styles')

@endpush
@section('content')
<div class="app-content-header">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Vehicle</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vehicle</li>
                </ol>
            </div>
        </div>

    </div>

</div>

<div class="app-content">

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="my-2">Add Vehicle</h4>

                              <a href="{{ route('vehicles.index') }}" class="btn btn-primary btn-sm my-2">&larr; Back</a>

                        </div>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('vehicles.store') }}" method="post">
                            @csrf

                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="number" class="col-md-4 col-form-label text-md-end text-start">Number</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="number" name="number" value="{{ old('number') }}">
                                    @if ($errors->has('number'))
                                        <span class="text-danger">{{ $errors->first('number') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Vehicle">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')

@endpush

