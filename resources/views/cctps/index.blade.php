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
            <form action="/searchCctp" method="get">
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
            @foreach($cctps as $cctp)
                <tr>
                    <td>{{$cctp->id_cctp}}</td>
                    <td>{{$cctp->nom_cctp}}</td>
                    <td>{{$cctp->prix_cctp}}</td>
                    <td><a href="{{ action('CctpController@sendToDevis', ['id_cctp' =>$cctp->id_cctp])}}" class="btn btn-primary">Add</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection