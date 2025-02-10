@extends('layouts.back')
@section('title', 'User Information')
@section('content')
<div class="app-content-header">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Users</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                            <h4 class="my-2">User Information</h4>
                            <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm my-2">&larr; Back</a>

                      </div>
                </div>
                <div class="card-body">

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Email Address:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                {{ $user->email }}
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Roles:</strong></label>
                            <div class="col-md-6" style="line-height: 35px;">
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="badge bg-primary">{{ $role }}</span>
                                @empty
                                @endforelse
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

@endsection
