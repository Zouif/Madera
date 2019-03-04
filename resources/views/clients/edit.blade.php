@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div>sdsq</div>
    <div class="card uper">
        <div class="card-header">
            Edit client
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('clients.update', $client->id_client) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="nom">nom client:</label>
                    <input type="text" class="form-control" name="nom_client" value="{{$client->nom_client}}" />
                </div>
                <div class="form-group">
                    <label for="prenom">prenom client:</label>
                    <input type="text" class="form-control" name="prenom_client" value="{{$client->prenom_client}}" />
                </div>
                <div class="form-group">
                    <label for="adresse">adresse client:</label>
                    <input type="text" class="form-control" name="adresse_client" value="{{$client->adresse_client}}"/>
                </div>
                <div class="form-group">
                    <label for="collectivite">collectivite client:</label>
                    <input type="text" class="form-control" name="nom_collectivite" value="{{$client->nom_collectivite}}" />
                </div>
                <div class="form-group">
                    <label for="telephone">telephone client:</label>
                    <input type="text" class="form-control" name="telephone_client" value="{{$client->telephone_client}}" />
                </div>
                <div class="form-group">
                    <label for="mail">mail client:</label>
                    <input type="text" class="form-control" name="mail_client" value="{{$client->mail_client}}" />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ action('ClientController@index') }}" class="btn btn-danger">Annuler</a>
            </form>
        </div>
    </div>
@endsection