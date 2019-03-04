@extends('layout')

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
            <form action="/searchCoupeprincipes" method="get">
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
                <td>ID</td>
                <td> nom</td>
                <td> prix</td>
            </tr>
            </thead>
            <tbody>
            @foreach($coupeprincipes as $coupe_principe)
                <tr>
                    <td>{{$coupe_principe->id_coupe_principe}}</td>
                    <td>{{$coupe_principe->nom_coupe_principe}}</td>
                    <td>{{$coupe_principe->prix_coupe_principe}}</td>
                    <td><a href="{{ action('CoupeprincipeController@sendToDevis', ['id_coupe_principe' =>$coupe_principe->id_coupe_principe])}}" class="btn btn-primary">Add</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection