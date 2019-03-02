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
            <form method="post" action="{{ route('projets.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="nom">nom projet:</label>
                    <input type="text" class="form-control" name="nom_projet"/>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <a href="http://127.0.0.1:8000/clients" class="btn btn-primary">
                            choisir client
                        </a>

                    </div>
                    <input type="text" class="form-control" name="ref_client" value="{{$id}}"/>
                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection