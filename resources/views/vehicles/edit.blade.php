@extends('layouts.back')
@section('title', 'Edit Vehicle')
@push('styles')

@endpush
@section('content')
<div class="app-content-header">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Vehicles</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
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
                            <a href="{{ route('vehicles.index') }}" class="btn btn-primary btn-sm my-2">&larr; Back</a>

                        </div>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="post">
                            @csrf
                            @method("PUT")                            

                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$vehicle->name) }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="number" class="col-md-4 col-form-label text-md-end text-start">Number</label>
                                <div class="col-md-6">
                                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="number" name="number" value="{{ old('number',$vehicle->number) }}">
                                    @if ($errors->has('number'))
                                        <span class="text-danger">{{ $errors->first('number') }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="mb-3 row">
                                <label for="roles" class="col-md-4 col-form-label text-md-end text-start">Roles</label>
                                <div class="col-md-6">
                                    <select class="form-control @error('roles') is-invalid @enderror select2" aria-label="Roles" id="roles" name="roles[]">
                                        @forelse ($roles as $role)

                                            @if ($role!='Super Admin')
                                            <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                            @else
                                                @if (Auth::user()->hasRole('Super Admin'))
                                                <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                                @endif
                                            @endif

                                        @empty

                                        @endforelse
                                    </select>
                                    @if ($errors->has('roles'))
                                        <span class="text-danger">{{ $errors->first('roles') }}</span>
                                    @endif
                                </div>
                            </div> --}}

                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Vehicle">
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
