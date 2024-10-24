@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/pickr/themes/classic.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Your Recipe</li>
        </ol>
    </nav>

    <div class="row">
        <div class="w-75 m-auto grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Your Recipe</h4>
                    <form  action="{{ route('recipes.update',$recipe) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" class="form-control @if($errors->any()) is-invalid @endif" name="title" value="{{$recipe->title}}" type="text">
                            @if($errors->any())
                                  <div class="invalid-feedback">
                                      title is required
                                  </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input id="image" required class="form-control @if($errors->any()) is-invalid @endif" name="image" value="{{$recipe->image}}" type="file">
                            @if($errors->any())
                                  <div class="invalid-feedback">
                                      Image is required
                                  </div>
                            @endif
                        </div>
                        <div id="ingredients-container" class="mb-3">
                            <h4>Ingrédients</h4>
                            <div class="ingredient-item">
                                @foreach($recipe->ingredientss as $ingredient)
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control @error('ingredients[0][name]') is-invalid @enderror" name="ingredients[0][name]" value="{{$ingredient->name}}" placeholder="Nom de l'ingrédient" required>
                                        @if('ingredients[0][name]')
                                            <div class="invalid-feedback">
                                                name ingredient required
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control @error('ingredients[0][quantity]') is-invalid @enderror" name="ingredients[0][quantity]" value="{{$ingredient->quantity}}" placeholder="Quantity" required>
                                        @if('ingredients[0][quantity]')
                                            <div class="invalid-feedback">
                                                quantity ingredient required
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control @error('ingredients[0][metric]') is-invalid @enderror" name="ingredients[0][metric]" value="{{$ingredient->metric}}" placeholder="Metric" required>
                                        @if('ingredients[0][metric]')
                                            <div class="invalid-feedback">
                                                metric ingredient required
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" class="form-control @error('ingredients[0][calories]') is-invalid @enderror" name="ingredients[0][calories]" value="{{$ingredient->calories}}" placeholder="Calories" required>
                                        @if('ingredients[0][calories]')
                                            <div class="invalid-feedback">
                                                calories ingredient required
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-secondary" id="add-ingredient"><i data-feather="plus"></i>Ajouter un ingrédient</button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <div>
                                @foreach($categories as $category)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="categories[]" class="form-check-input @if($errors->any()) is-invalid @endif" @if($recipe->categories->contains($category->id)) checked @endif id="checkInline{{$category->id}}" value="{{ $category->id }}">
                                        @if($errors->any())
                                          <div class="invalid-feedback">
                                              categories is required
                                          </div>
                                        @endif
                                        <label class="form-check-label" for="checkInline{{$category->id}}">
                                            {{$category->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="nutrition" class="form-label">Nutrition</label>
                            <input class="form-control @error("nutrition") is-invalid @enderror" id="nutrition" name="nutrition" rows="5" value="{{ $recipe->nutrition }}" />
                            @error("nutrition")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="prepTime" class="form-label">Prepare Time</label>
                            <input class="form-control @error("prepTime") is-invalid @enderror" id="prepTime" name="prepTime" rows="5" value="{{ $recipe->prepTime }}" />
                            @error("prepTime")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cookTime" class="form-label">Cooking Time</label>
                            <input class="form-control @error("cookTime") is-invalid @enderror" id="cookTime" name="cookTime" rows="5" value="{{ $recipe->cookTime }}" />
                            @error("cookTime")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="video" class="form-label">Url Video</label>
                            <input class="form-control @error("video") is-invalid @enderror" id="video" name="video" rows="5" value="{{ $recipe->video }}" />
                            @error("video")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea class="form-control @error("summary") is-invalid @enderror" id="summary" name="summary" rows="5">{{$recipe->summary}}</textarea>
                            @error("summary")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="instructions" class="form-label">Instructions</label>
                            <textarea class="form-control @error("instructions") is-invalid @enderror" id="instructions" name="instructions" rows="5">{{ $recipe->instructions }}</textarea>
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
    <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/typeahead-js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pickr/pickr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/pickr.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

@endpush

