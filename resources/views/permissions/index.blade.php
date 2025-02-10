@extends('layouts.back')
@section('title', 'Manage Permmissions')
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
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="my-2">Permissions List</h4>
                      @can('permissions.create')
                          <form action="{{ route('permissions.store') }}" method="post">
                                @csrf
                              <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-plus-lg"></i> Generate Permission</button>
                          </form>
                      @endcan
                </div>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Name</th>
                  </tr>
                  @forelse ($permissions as $permission)
                    <tr>
                        <th scope="row">{{ $loop->iteration+($permissions->perPage()*($permissions->currentPage()-1)) }}</th>
                        <td>{{ $permission->name }}</td>
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
                        {{ $permissions->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      </div>


@endsection
