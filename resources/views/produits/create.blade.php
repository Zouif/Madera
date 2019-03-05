@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>

    <div class="card uper">
        <div class="card-header">
            Produit
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
            <form method="post" action="{{ route('produits.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nom">nom produit:</label>
                    <input type="text" class="form-control" name="nom_produit"/>
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="nom">taux tva:</label>--}}
                    {{--<input type="text" class="form-control" name="nom_projet"/>--}}
                {{--</div>--}}
                <div class="form-group">
                    <label for="nom">nombre produit:</label>
                    <input type="text" class="form-control" name="quantite_produit"/>
                </div>
                <div class="form-group">
                    <label for="nom">prix produit ht:</label>
                    <input type="text" class="form-control" name="prix_produit_ht" value="{{ session()->get('prix_produit_ht') }}"/>
                </div>

                <div class="form-group">

                    {{--COUVERTURE--}}
                    <div class="input-group m-2">
                        <a href="{{ url('couvertures')}}" class="btn btn-primary">
                            Choisir Couverture
                        </a>
                    </div>
                    @if(session()->get('couverture'))
                        <input type="text" class="form-control" name="nom_couverture" value="{{ session()->get('couverture.nom_couverture') }}" readonly/>
                    @endif

                    {{--CCTP--}}
                    <div class="input-group m-2">
                        <a href="{{ url('cctps')}}" class="btn btn-primary">
                            Choisir Cctp
                        </a>
                    </div>
                    @if(session()->get('cctp'))
                        <input type="text" class="form-control" name="nom_cctp" value="{{ session()->get('cctp.nom_cctp') }}" readonly/>
                    @endif

                    {{--COUPE PRINCIPE--}}
                    <div class="input-group m-2">
                        <a href="{{ url('coupeprincipes')}}" class="btn btn-primary">
                            Choisir Coupe Principe
                        </a>
                    </div>
                    @if(session()->get('coupeprincipe'))
                        <input type="text" class="form-control" name="nom_coupe_principe" value="{{ session()->get('coupeprincipe.nom_coupe_principe') }}" readonly/>
                    @endif

                    {{--GAMME--}}
                    <div class="input-group m-2">
                        <a href="{{ url('gammes')}}" class="btn btn-primary">
                            Choisir Gamme
                        </a>
                    </div>
                    @if(session()->get('gamme'))
                        <input type="text" class="form-control" name="nom_gamme" value="{{ session()->get('gamme.nom_gamme') }}" readonly/>
                    @endif

                    {{--MODULE--}}
                    <div class="input-group m-2">
                        <a href="{{ url('modules')}}" class="btn btn-primary">
                            Add Module
                        </a>
                    </div>
                    @if(session()->get('modules'))
                        @foreach (session()->get('modules') as $key=>$module)
                            <div class="input-group m-2">
                                <input type="text" class="form-control" name="nom_module" value="{{ $module->nom_module }}" readonly/>
                                <a href="{{ action('ProduitController@deleteModule', ['key_module' => $key]) }}" class="btn btn-danger">Supprimer</a>
                            </div>
                        @endforeach
                    @endif

                </div>

                <button type="submit" class="btn btn-primary">Add</button>
                <a href="{{ url('produits')}}" class="btn btn-primary">
                    Retour liste produits
                </a>
            </form>
        </div>
    </div>
@endsection