@extends('layouts.back')
@section('title', 'Manage Vehicle')
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Vehicle</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between">
                        <h4 class="my-2">Vehicles List</h4>
                          @can('vehicles.create')
                              <a href="{{ route('vehicles.create') }}" class="btn btn-success btn-sm my-2"><i class="fa fa-plus"></i> Add New User</a>
                          @endcan
                    </div>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped" id="users-table">
                        <thead>
                            <tr>
                                <th scope="col" width="1%">S#</th>
                                <th scope="col" width="20%">Name</th>
                                <th scope="col" width="20%">Number</th>
                                <th scope="col" width="19%">Action</th>
                              </tr>
                        </thead>
                            <tbody>
                                @foreach ($vehicles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration+($vehicles->perPage()*($vehicles->currentPage()-1)) }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->number }}</td>
                                        <td>
                                            
                                            @can('vehicles.edit')
                                                <a href="{{ route('vehicles.edit', $item->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                            @endcan



                                                @can('vehicles.destroy')
                                                    <form action="{{ route('vehicles.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');"><i class="bi bi-trash"></i> Delete</button>
                                                    </form>
                                                @endcan
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $vehicles->links() }}
                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
     <!--end::Container-->
</div>



@endsection
@push('scripts')
  <script>

  </script>
@endpush


