@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
   {{-- @dump($recipes)--}}

   <nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Tables</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Table Recipes</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items my-3">
            <h6 class="card-title">Data Table Recipes</h6>
            <a href="{{route('recipes.create')}}" class="btn btn-primary">Create</a>
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
                <th>Image</th>
                <th>Title</th>
                  <th>Ingredient</th>
                <th>Start date</th>
                  <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @if($recipes)
            @foreach($recipes as $recipe)
              <tr>
                <td><img src="{{asset('storage/'.$recipe->image)}}" alt="Image des recêtte"></td>
                <td>{{$recipe->title}}</td>
                  <td>
                      <select class="form-control" name="age_select" id="ageSelect">
                          @foreach($recipe->ingredientss as $ingredients)
                          <option selected disabled>
                               {{$ingredients->name}}:{{$ingredients->quantity}}
                          </option>
                          @endforeach
                      </select>
                  </td>
                <td>{{ $recipe->created_at }}</td>
                  <td class="d-flex d-inline-block gap-2">
                      <form action="{{ route('recipes.destroy',$recipe->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <div class="btn btn-transparent"
                               style="
                                border-radius: 50% !important;
                                padding-left: 10px !important;
                                padding-right: 10px !important;
                                padding-top: 5px !important;
                                padding-bottom: 10px !important;
                                border-color: #8c0615 !important">
                              <i class="text-danger" data-feather="delete"></i>
                          </div>
                      </form>
                      <a class="btn btn-sm btn-success" href="{{route('recipes.edit',$recipe->id)}}">
                          <i data-feather="edit"></i>
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
