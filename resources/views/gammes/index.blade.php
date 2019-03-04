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
            <form action="/searchGammes" method="get">
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
                <td> Finition</td>
                <td> Huisseries</td>
                <td> Isolant</td>
                <td> Prix</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($gammes as $gamme)
                <tr>
                    <td>{{$gamme->nom_gamme}}</td>
                    <td>{{$gamme->finition_gamme}}</td>
                    <td>{{$gamme->huisseries_gamme}}</td>
                    <td>{{$gamme->isolant_gamme}}</td>
                    <td>{{$gamme->prix_gamme}}</td>
                    <td><a href="{{ action('GammeController@sendToDevis', ['id_gamme' =>$gamme->id_gamme])}}" class="btn btn-primary">Add</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection