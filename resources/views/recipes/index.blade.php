@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    {{-- @dump($recipes)--}}
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Recipes</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            @if(Session::has("success"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get("success") }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                </div>
            @endif

            @if(Session::has("error"))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ Session::get("erreur") }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                </div>
            @endif
        </div>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items my-3">
                        <h6 class="card-title">Recipes</h6>
                        <a href="{{route('recipes.create')}}" class="btn btn-primary">Add New recipe</a>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="no-sort">Image</th>
                                <th>Title</th>
                                <th>Ingredients</th>
                                <th>Categories</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($recipes)
                                @foreach($recipes as $recipe)
                                    <tr>
                                        <td><img src="{{asset('storage/'.$recipe->image)}}" alt="Image du recipe"></td>
                                        <td>{{$recipe->title}}</td>
                                        <td>
                                            @if($recipe->ingredientss)
                                                @foreach($recipe->ingredientss as $ingredient)
                                                    <div class="badge bg-primary">{{$ingredient->quantity}}{{$ingredient->metric}} {{$ingredient->name}}</div>
                                                @endforeach
                                            @endif

                                        </td>
                                        <td>
                                            @if($recipe->categories)
                                                @foreach($recipe->categories as $category)
                                                    <div class="badge bg-primary">{{$category->name}}</div>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="actions">
                                            <form action="{{ route('recipes.destroy',$recipe->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger circle">
                                                    <i data-feather="delete"></i>
                                                </button>
                                            </form>
                                            <a class="btn btn-sm btn-success circle" href="{{route('recipes.edit',$recipe->id)}}">
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
