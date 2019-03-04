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
                        <a href="{{ url('couverture')}}" class="btn btn-primary">
                            Add Couverture
                        </a>
                    </div>
                    @if(session()->get('id'))
                        <input type="text" class="form-control" name="ref_client" value="{{ session()->get('id') }}"/>
                    @endif

                    {{--CCTP--}}
                    <div class="input-group m-2">
                        <a href="{{ url('cctp')}}" class="btn btn-primary">
                            Add Cctp
                        </a>
                    </div>
                    @if(session()->get('id'))
                        <input type="text" class="form-control" name="ref_client" value="{{ session()->get('id') }}"/>
                    @endif

                    {{--COUPE PRINCIPE--}}
                    <div class="input-group m-2">
                        <a href="{{ url('coupeprincipe')}}" class="btn btn-primary">
                            Add Coupe Principe
                        </a>
                    </div>
                    @if(session()->get('id'))
                        <input type="text" class="form-control" name="ref_client" value="{{ session()->get('id') }}"/>
                    @endif

                    {{--GAMME--}}
                    <div class="input-group m-2">
                        <a href="{{ url('gamme')}}" class="btn btn-primary">
                            Add Gamme
                        </a>
                    </div>
                    @if(session()->get('id'))
                        <input type="text" class="form-control" name="ref_client" value="{{ session()->get('id') }}"/>
                    @endif

                    {{--MODULE--}}
                    <div class="input-group m-2">
                        <a href="{{ url('module')}}" class="btn btn-primary">
                            Add Module
                        </a>
                    </div>
                    @if(session()->get('module'))
                        @foreach (session()->get('module') as $module)
                            <input type="text" class="form-control" name="ref_client" value="{{ session()->get('id') }}"/>
                        @endforeach
                    @endif

                </div>

                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
@endsection