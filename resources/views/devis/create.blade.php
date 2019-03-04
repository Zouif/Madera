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
            <form method="post" action="{{ route('projets.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="nom">nom projet:</label>
                    <input type="text" class="form-control" name="nom_projet"/>
                </div>

                <div class="form-group">

                    {{--COUVERTURE--}}
                    <div class="input-group m-2">
                        <a href="{{ url('couvertures')}}" class="btn btn-primary">
                            Choisir Couverture
                        </a>
                    </div>
                    @if(session()->get('id'))
                        <input type="text" class="form-control" name="ref_client" disabled="disabled" value="{{ session()->get('id') }}"/>
                    @endif

                    {{--CCTP--}}
                    <div class="input-group m-2">
                        <a href="{{ url('cctps')}}" class="btn btn-primary">
                            Choisir Cctp
                        </a>
                    </div>
                    @if(session()->get('id'))
                        <input type="text" class="form-control" name="ref_client" disabled="disabled" value="{{ session()->get('id') }}"/>
                    @endif

                    {{--COUPE PRINCIPE--}}
                    <div class="input-group m-2">
                        <a href="{{ url('coupeprincipes')}}" class="btn btn-primary">
                            Choisir Coupe Principe
                        </a>
                    </div>
                    @if(session()->get('id'))
                        <input type="text" class="form-control" name="ref_client" disabled="disabled" value="{{ session()->get('id') }}"/>
                    @endif

                    {{--GAMME--}}
                    <div class="input-group m-2">
                        <a href="{{ url('gammes')}}" class="btn btn-primary">
                            Choisir Gamme
                        </a>
                    </div>
                    @if(session()->get('id'))
                        <input type="text" class="form-control" name="ref_client" disabled="disabled" value="{{ session()->get('id') }}"/>
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
                                <input type="text" class="form-control" name="nom_module" disabled="disabled" value="{{ $module->nom_module }}"/>
                                <a href="{{ action('DevisController@deleteModule', ['key_module' => $key]) }}" class="btn btn-danger">Supprimer</a>
                            </div>
                        @endforeach
                    @endif

                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection