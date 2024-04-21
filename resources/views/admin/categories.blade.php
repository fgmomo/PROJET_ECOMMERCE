@extends('layouts.appadmin')
@section('tile')
    Categorie
@endsection
@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@elseif (session('Supstatus'))
<div class="alert alert-danger">
    {{ session('Supstatus') }}
</div>
@endif


    <div class="card">
            <div class="card-body">
                <h4 class="card-title">Catégories</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Nom de la Catégorie</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category )
                                    <tr>
                                        <td>{{$category->id}}</td>
                                        <td>{{$category->category_name}}</td>
                                        {{-- <td>
                                            <label class="badge badge-info">On hold</label>
                                        </td> --}}
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="window.location='{{URL::to('/edit_categorie/'.$category->id)}}'">Edit</button>
                                            <button class="btn btn-outline-danger" onclick="window.location='{{URL::to('/delete_categorie/'.$category->id)}}'">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
@section('script')
<script src="backend/js/data-table.js"></script>

@endsection
