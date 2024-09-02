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
          <li class="breadcrumb-item"><a href="#">Roles et permessions</a></li>
          <li class="breadcrumb-item active" aria-current="page">Nouveau role</li>
     </ol>
</nav>

<div class="row">
     <div class="w-75 m-auto grid-margin stretch-card">
          <div class="card">
               <div class="card-header">
                    <h5 class="mb-0 h6">{{__('Ajouter un nouveau rôle')}}</h5>
               </div>
               <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                         <div class="form-group mb-3">
                              <label class="from-label" for="name">{{__('Nom du rôle')}}</label>
                              <input type="text" placeholder="{{__('Nom du rôle')}}" id="name" name="name" class="form-control" required>
                         </div>

                         <div class="card-header mb-3 d-flex px-0 justify-content-between">
                              <h4 class="mb-0">{{ __('Permissions') }}</h5>
                              <div>
                                   <button type="button" class="btn btn-primary btn-sm text-white" id="selectAll">Tout sélectionner</button>
                                   <a href="{{ route('roles.permissions.store') }}" class="btn btn-success btn-sm">Charger les permissions</a>
                              </div>
                         </div>
                         <br>

                         @foreach ($permission_groups as $key => $permission_group)
                              <ul class="list-group mb-4">
                                   <li class="list-group-item bg-light" aria-current="true"> {{ __(Str::headline($permission_group[0]['section'])) }}</li>
                                   <li class="list-group-item">
                                        <div class="row">
                                             @foreach ($permission_group as $key => $permission)
                                             <div class="col-3">
                                                  <div class="p-2 border mt-1 mb-2 d-flex justify-content-between">
                                                       <label class="control-label d-flex">{{ __(Str::headline($permission->name)) }}</label>
                                                       <div class="form-check form-switch">
                                                            <input type="checkbox" class="form-check-input" name="permissions[]" class="form-control demo-sw" value="{{ $permission->name }}">
                                                            <span class="slider round"></span>
                                                       </div>
                                                  </div>
                                             </div>
                                             @endforeach
                                        </div>
                                   </li>
                              </ul>
                         @endforeach

                         <div class="form-group mb-3 mt-3 text-right">
                              <button type="submit" class="btn btn-primary">{{__('Sauvegarder')}}</button>
                         </div>
                    </div>
               </form>
          </div>
     </div>
</div>
@endsection

@push('plugin-scripts')
     <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
@endpush

@push('custom-scripts')
     <script src="{{ asset('assets/js/bootstrap-maxlength.js') }}"></script>
     <script src="{{ asset('assets/js/script.js') }}"></script>

     <script>
          $(document).ready(function() {
              $('#selectAll').click(function() {
                  console.log(this.checked);
                  $('input:checkbox').not(this).attr('checked', true)
              });
          });
      </script>
@endpush