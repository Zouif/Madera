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
                <a href="{{ url('/produits/create') }}" class="">
                    <button type="submit" class="btn btn-primary">Ajouter un produit</button>
                </a>
            </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <td>nom_produit</td>
                <td> prix_produit_ht</td>
                <td> id_couverture</td>
                <td> id_cctp</td>
                <td> id_gamme</td>
                <td> id_coupe_principe</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($listeproduits as $produit)
                <tr>
                    <td>{{$produit->nom_produit}}</td>
                    <td>{{$produit->prix_produit_ht}}</td>
                    <td>{{$produit->id_couverture}}</td>
                    <td>{{$produit->id_cctp}}</td>
                    <td>{{$produit->id_gamme}}</td>
                    <td>{{$produit->id_coupe_principe}}</td>
                    <td><a href="{{ route('produits.edit',$produit->id_produit)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('produits.destroy', $produit->id_produit)}}" method="post">
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