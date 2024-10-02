@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Forms</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Your Recipe</li>
  </ol>
</nav>

<div class="row">
  <div class="w-75 m-auto grid-margin stretch-card">
    <div class="card">
      <div class="card-body">

        <h4 class="card-title mb-5">Add Your Recipe</h4>

        <div class="w-100">
          @if($errors->any())
            <div class="alert alert-dander fade show" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
      </div>

        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label for="name" class="form-label">Title</label>
            <input type="text" id="name" class="form-control @error("name") is-invalid @enderror" name="title" value="{{ old('name') }}">
            @error("name")
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" id="image" class="form-control @error("image") is-invalid @enderror" name="image">
            @error("image")
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div id="ingredients-container" class="mb-3 mt-4">
            <h4 class="mb-2">Ingrédients</h4>
            <div class="ingredient-item mb-2">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control @error("ingredients[0][name]") is-invalid @enderror"
                    name="ingredients[0][name]" placeholder="Nom de l'ingrédient" value="{{ old('ingredients[0][name]') }}" required>
                  @error("ingredients[0][name]")
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control @error("ingredients[0][quantity]") is-invalid @enderror"
                    name="ingredients[0][quantity]" placeholder="Quantité" value="{{ old('ingredients[0][quantity]') }}" required>
                  @error("ingredients[0][quantity]")
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <button type="button" class="btn btn-secondary" id="add-ingredient">
              <i data-feather="plus"></i>
              Ajouter un ingrédient
            </button>
          </div>

          <div class="mb-3">
            <label class="form-label">Categories</label>
            <div>
                @foreach($categories as $category)
                <div class="form-check form-check-inline">
                  <input type="checkbox" name="categories[]" class="form-check-input @error("categories") is-invalid @enderror" id="checkInline{{$category->id}}"
                    value="{{ $category->id }}">
                  <label class="form-check-label" for="checkInline{{$category->id}}">
                    {{$category->name}}
                  </label>

                  @error("categories")
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
                @endforeach
            </div>
          </div>

          <div class="mb-3">
            <label for="nutrition" class="form-label">Nutrition</label>
            <input class="form-control @error("nutrition") is-invalid @enderror" id="nutrition" name="nutrition" rows="5" value="{{ old('nutrition') }}" />
            @error("nutrition")
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="prepTime" class="form-label">Prepare Time</label>
            <input class="form-control @error("prepTime") is-invalid @enderror" id="prepTime" name="prepTime" rows="5" value="{{ old('prepTime') }}" />
            @error("prepTime")
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="cookTime" class="form-label">Cooking Time</label>
            <input class="form-control @error("cookTime") is-invalid @enderror" id="cookTime" name="cookTime" rows="5" value="{{ old('cookTime') }}" />
            @error("cookTime")
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="video" class="form-label">Url Video</label>
            <input class="form-control @error("video") is-invalid @enderror" id="video" name="video" rows="5" value="{{ old('video') }}" />
            @error("video")
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="summary" class="form-label">Summary</label>
            <textarea class="form-control @error("summary") is-invalid @enderror" id="summary" name="summary" rows="5">{{ old('summary') }}</textarea>
            @error("summary")
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="instructions" class="form-label">Instructions</label>
            <textarea class="form-control @error("instructions") is-invalid @enderror" id="instructions" name="instructions" rows="5">{{ old('instructions') }}</textarea>
            @error("instructions")
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>

          <button class="btn btn-primary" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>

</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
@endpush