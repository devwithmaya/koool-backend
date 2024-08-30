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
                <th>Ingredients</th>
                  <th>Categories</th>

                  <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            @if($recipes)
            @foreach($recipes as $recipe)
              <tr>
                <td><img src="{{asset('storage/'.$recipe->image)}}" alt="Image du recipe"></td>
                <td>{{$recipe->title}}</td>
                <td>
                    <select class="js-example-basic-single form-control"  data-width="100%">
                        @if($recipe->ingredientss)
                            @foreach($recipe->ingredientss as $ingredient)
                                <option value="">{{$ingredient->name}}({{$ingredient->quantity}}g)</option>
                            @endforeach
                        @endif
                    </select>
                </td>
                  <td>
                      <select class="js-example-basic-single form-control"  data-width="100%">
                          @if($recipe->categories)
                              @foreach($recipe->categories as $category)
                                  <option value="">{{$category->name}}</option>
                              @endforeach
                          @endif
                      </select>
                  </td>
                  <td class="d-flex d-inline-block gap-2">
                      <form action="{{ route('recipes.destroy',$recipe->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-danger">
                              <i data-feather="delete"></i>
                          </button>
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
