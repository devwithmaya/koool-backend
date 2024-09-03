@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Tables</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Table Ingredients</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="d-flex justify-content-between align-items my-3">
              <h6 class="card-title">Data Table Ingredients</h6>
              <a href="{{route('ingredients.create')}}" class="btn btn-primary">Create</a>
          </div>
          <div class="table-responsive">
            @if(session('success'))
                <div class="w-50 m-auto alert bg-alert-success">
                    <p class="text-center">{{ session('success') }}</p>
                </div>
            @endif
          <table id="dataTableExample" class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th class="no-sort">Actions</th>
              </tr>
            </thead>
            <tbody>
            @if($ingredients)
            @foreach($ingredients as $recipe)
              <tr>
                <td>{{$recipe->name}}</td>
                <td>{{$recipe->quantity}}</td>
                  <td class="d-flex d-inline-block gap-2">
                      <form action="{{ route('ingredients.destroy',$recipe->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-danger">
                              <i data-feather="delete"></i>
                          </button>
                      </form>
                      <a class="btn btn-sm btn-success" href="{{route('ingredients.edit',$recipe->id)}}">
                          <i data-feather="edit-3"></i>
                      </a>
                  </td>
              </tr>
            @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush
