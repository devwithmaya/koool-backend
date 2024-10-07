@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    {{-- @dump($meals)--}}
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Settings</li>
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
                    <h4>Version</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"></li>
                        <li class="list-group-item">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon2">version-koool/</span>
                                <form method="post" action="{{ route(isset($setting) && $setting->exists ? 'settings.update' : 'settings.store',$setting)}}">
                                    @csrf
                                    @method(isset($setting) && $setting->exists ? 'PUT' : 'POST')
                                    <input type="text" name="version" value="{{isset($setting) && $setting->exists ? $setting->version : ''}}" placeholder="Saisir la version" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                </form>
                            </div>
                        </li>
                        <li class="list-group-item"></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items">
                        <h4 class="mt-1">Mode Maintenance</h4>
                        <form action="{{ route('maintenance') }}" method="POST">
                            @csrf
                            <div class="form-check form-switch mb-2">
                                <input type="checkbox" class="form-check-input" id="formSwitch1" name="maintenance_mode" onchange="this.form.submit()"
                                       @if(App::isDownForMaintenance()) checked @endif>
                                <label class="form-check-label" for="formSwitch1">
                                    {{ App::isDownForMaintenance() ? 'Désactiver le mode maintenance' : 'Activer le mode maintenance' }}
                                </label>
                            </div>
                        </form>
                    </div>
                    {{--<form action="{{ route('active') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="excluded_routes" class="form-label">Routes à exclure</label>
                            <input type="text" name="excluded_routes[]" class="form-control" placeholder="/login" />
                            <input type="text" name="excluded_routes[]" class="form-control mt-2" placeholder="/api/*" />
                        </div>
                        <button type="submit" class="btn btn-danger">Activer le mode maintenance</button>
                    </form>--}}

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
