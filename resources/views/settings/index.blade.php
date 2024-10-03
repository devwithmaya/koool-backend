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
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon2">version-koool</span>
                                <form method="post" action="{{ route($setting -> exists ? 'settings.update' : 'settings.store',$setting)}}">
                                    @csrf
                                    @method($setting->exists ? 'PUT' : 'POST')
                                    <input type="text" name="version" value="{{$setting->version}}" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                </form>
                            </div>
                        </li>
                        <li class="list-group-item"></li>
                    </ul>
                    <h4>Mode Maintenance</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"></li>
                        <li class="list-group-item d-flex justify-content-between align-items">
                            <h5 class="mt-1">Activer</h5>
                            <a href="{{route('active')}}" class="btn btn-sm btn-primary">Activer</a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items">
                            <h5 class="mt-1">Désactiver</h5>
                            <a href="{{route('desactive')}}" class="btn btn-sm btn-primary">Désactiver</a>
                        </li>
                        <li class="list-group-item"></li>
                    </ul>
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
