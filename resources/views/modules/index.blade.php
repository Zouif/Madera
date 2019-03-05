@extends('layout')
<script src="{{ asset('js/modules_liste.js') }}" type="text/js"></script>

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
        <div class="col-md-4 mb-3">
            <form action="/searchModules" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Chercher</button>
                    </span>
                </div>
            </form>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <td> Nom</td>
                <td> Description</td>
                <td> Prix</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($modules as $module)
                <tr>
                    <td>{{$module->nom_module}}</td>
                    <td>{{$module->description_module}}</td>
                    <td>{{$module->prix_module}}</td>
                    <td><a href="{{ action('ModuleController@sendToDevis', ['id_module' =>$module->id_module])}}" class="btn btn-primary">Add</a></td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <div>
@endsection