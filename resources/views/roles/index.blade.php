@extends('layouts.back')
@section('title', 'Manage Roles')
@section('content')
<!-- Content Header (Page header) -->
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
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="my-2">Roles List</h4>
                      @can('roles.create')
                          <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm my-2"><i class="fa fa-plus"></i> Add New Role</a>
                      @endcan
                </div>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Name</th>
                    <th scope="col" width="250px">Action</th>
                  </tr>
                  @forelse ($roles as $role)
                    <tr>
                        <th scope="row">{{ $loop->iteration+($roles->perPage()*($roles->currentPage()-1))}}</th>
                        <td>{{ $role->name }}</td>
                        <td>
                            <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                @can('show-role')
                                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                @endcan
                                @if ($role->name!='Super Admin')
                                    @can('edit-role')
                                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @endcan

                                    @can('roles.destroy')
                                        @if ($role->name!=Auth::user()->hasRole($role->name))
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this role?');"><i class="bi bi-trash"></i> Delete</button>
                                        @endif
                                    @endcan
                                @endif

                            </form>
                        </td>
                    </tr>
                    @empty
                    <td colspan="3">
                        <span class="text-danger">
                            <strong>No Role Found!</strong>
                        </span>
                    </td>
                @endforelse
                </table>
                <div class="d-flex justify-content-end">
                    {{ $roles->links() }}
            </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      </div>
      </div>



@endsection
