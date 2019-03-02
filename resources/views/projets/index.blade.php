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
            <form action="/searchProjets" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Chercher</button>
                    </span>
                </div>
            </form>
        </div>
            <div class="text-center mb-3">
                <a href="{{ url('/projets/aaaaa') }}" class="">
                    <button type="submit" class="btn btn-primary">Creer un nouveau projet</button>
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
            @foreach($projets as $projet)
                <tr>
                    <td>{{$projet->id_client}}</td>
                    <td>{{$projet->nom_projet}}</td>
                    <td>{{$projet->date_projet}}</td>
                    <td>{{$projet->ref_projet}}</td>
                    <td><a href="{{ route('projets.edit',$projet->id_projet)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('projets.destroy', $projet->id_projet)}}" method="post">
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