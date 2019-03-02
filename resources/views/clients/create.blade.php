@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>

    <div class="card uper">
        <div class="card-header">
            Add Share
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
            <form method="post" action="{{ route('clients.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="nom">nom client:</label>
                    <input type="text" class="form-control" name="nom_client"/>
                </div>
                <div class="form-group">
                    <label for="prenom">prenom client :</label>
                    <input type="text" class="form-control" name="prenom_client"/>
                </div>
                <div class="form-group">
                    <label for="adresse">adresse client:</label>
                    <input type="text" class="form-control" name="adresse_client"/>
                </div>
                <div class="form-group">
                    <label for="collectivite">collectivite client:</label>
                    <input type="text" class="form-control" name="nom_collectivite"/>
                </div>
                <div class="form-group">
                    <label for="telephone">telephone client:</label>
                    <input type="text" class="form-control" name="telephone_client"/>
                </div>
                <div class="form-group">
                    <label for="mail">mail client:</label>
                    <input type="text" class="form-control" name="mail_client"/>
                </div>
                <div class="form-group">
                    <label for="ref">ref client:</label>
                    <input type="text" class="form-control" name="ref_client"/>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection