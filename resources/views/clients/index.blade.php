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
            <form action="/searchClients" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Chercher</button>
                    </span>
                </div>
            </form>
        </div>
            <div class="text-center mb-3">
                <a href="{{ url('/clients/create') }}" class="">
                    <button type="submit" class="btn btn-primary">Creer un nouveau client</button>
                </a>
            </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td> nom</td>
                <td> prenom</td>
                <td> adresse</td>
                <td> collectivite</td>
                <td> telephone</td>
                <td> mail</td>
                <td> ref</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{$client->id_client}}</td>
                    <td>{{$client->nom_client}}</td>
                    <td>{{$client->prenom_client}}</td>
                    <td>{{$client->adresse_client}}</td>
                    <td>{{$client->nom_collectivite}}</td>
                    <td>{{$client->telephone_client}}</td>
                    <td>{{$client->mail_client}}</td>
                    <td>{{$client->ref_client}}</td>
                    <td><a href="{{ route('clients.edit',$client->id_client)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('clients.destroy', $client->id_client)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                    <td><a href="{{ route('projets.show', $client->ref_client) }}" class="btn btn-primary">Add project with this client</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection