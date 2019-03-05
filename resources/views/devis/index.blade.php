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
            <div class="text-center mb-3">
                <a href="{{ url('/devis/create') }}" class="">
                    <button type="submit" class="btn btn-primary">Creer un nouveau devis</button>
                </a>
            </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <td>ref_devis</td>
                <td> date_devis</td>
                <td> duree_val_devis</td>
                <td> taux_horaire_main_oeuvre</td>
                <td> montant_depla</td>
                <td> prix_presta</td>
                <td> taux_tva</td>
                <td> montant_tva</td>
                <td> prix_total_ht</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($listedevis as $devis)
                <tr>
                    <td>{{$devis->ref_devis}}</td>
                    <td>{{$devis->date_devis}}</td>
                    <td>{{$devis->duree_validite_devis}}</td>
                    <td>{{$devis->taux_horaire_main_oeuvre}}</td>
                    <td>{{$devis->montant_frais_deplacement}}</td>
                    <td>{{$devis->prix_prestation}}</td>
                    <td>{{$devis->taux_tva}}</td>
                    <td>{{$devis->montant_tva}}</td>
                    <td>{{$devis->prix_total_ht}}</td>
                    <td><a href="{{ route('devis.edit',$devis->id_devis)}}" class="btn btn-primary">Edit</a></td>
                    <td><a href="{{ route('produits.show', $devis->id_devis) }}" class="btn btn-primary">Produits</a></td>
                    <td>
                        <form action="{{ route('devis.destroy', $devis->id_devis) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
@endsection