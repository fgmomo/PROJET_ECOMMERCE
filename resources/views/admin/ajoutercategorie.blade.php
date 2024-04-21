@extends('layouts.appadmin')
@section('title')
    add categorie
@endsection
@section('content')
    <div class="row grid-margin">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ajouter Categorie</h4>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form class="cmxform" id="commentForm" method="post" action="{{ route('sauver_categorie') }}">
                        @csrf
                        <div class="form-group">
                            <label for="cname">Nom de la Catégorie</label>
                            <input id="cname" class="form-control" name="category_name" type="text">
                        </div>

                        <input class="btn btn-primary" type="submit" value="Ajouter">

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {{-- <script src="backend/js/form-validation.js"></script>
<script src="backend/js/bt-maxLength.js"></script> --}}
@endsection
