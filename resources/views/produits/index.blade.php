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
                <td>ID Client</td>
                <td> nom</td>
                <td> date</td>
                <td> ref</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($listedevis as $devis)
                <tr>
                    <td>{{$devis->id_client}}</td>
                    <td>{{$devis->nom_projet}}</td>
                    <td>{{$devis->date_projet}}</td>
                    <td>{{$devis->ref_projet}}</td>
                    <td><a href="{{ route('projets.edit',$devis->id_devis)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('projets.destroy', $devis->id_devis)}}" method="post">
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