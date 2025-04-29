@extends('layouts.back')
@section('title', 'Edit Driver')
@push('styles')

@endpush
@section('content')
<div class="app-content-header">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Drivers</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Drivers</li>
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
                            <h4 class="my-2">Edit Vehicle</h4>
                            <a href="{{ route('drivers.index') }}" class="btn btn-primary btn-sm my-2">&larr; Back</a>

                        </div>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('drivers.update', $driver->id) }}" method="post">
                            @csrf
                            @method("PUT")

                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$driver->name) }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="number" class="col-md-4 col-form-label text-md-end text-start">Mobile</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile',$driver->mobile) }}">
                                    @if ($errors->has('mobile'))
                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">d
                                <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $driver->email) }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Driver">
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
