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
            Edit Projet
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
            <form method="post" action="{{ route('projets.update', $projet->id_projet) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="nom">nom projet:</label>
                    <input type="text" class="form-control" name="nom_projet" value="{{$projet->nom_projet}}" />
                </div>
                <div class="form-group">
                    <label for="prenom">date projet:</label>
                    <input type="text" class="form-control" name="date_projet" value="{{$projet->date_projet}}" />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ action('ProjetController@index') }}" class="btn btn-danger">Annuler</a>
            </form>
        </div>
    </div>
@endsection