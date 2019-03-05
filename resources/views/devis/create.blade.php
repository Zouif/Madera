@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>

    <div class="card uper">
        <div class="card-header">
            Add Devis
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
            <form method="post" action="{{ route('devis.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nom">duree_validite_devis:</label>
                    <input type="text" class="form-control" name="duree_validite_devis"/>
                </div>
                <div class="form-group">
                    <label for="prenom">taux_horaire_main_oeuvre :</label>
                    <input type="text" class="form-control" name="taux_horaire_main_oeuvre"/>
                </div>
                <div class="form-group">
                    <label for="adresse">montant_frais_deplacement:</label>
                    <input type="text" class="form-control" name="montant_frais_deplacement"/>
                </div>
                <div class="form-group">
                    <label for="collectivite">prix_prestation:</label>
                    <input type="text" class="form-control" name="prix_prestation"/>
                </div>
                <div class="form-group">
                    <label for="mail">taux_tva:</label>
                    <input type="text" class="form-control" name="taux_tva"/>
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection