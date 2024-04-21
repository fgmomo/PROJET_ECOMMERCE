@extends('layouts.appadmin')
@section('tile')
    Produit
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
                <h4 class="card-title">Produits</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table" da>
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Image</th>
                                        <th>Nom du Produit</th>
                                        <th>Categorie du Produit</th>
                                        <th>Prix du Produit</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produit as $product )


                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td> <img src="storage/product_images/{{ $product->product_image}}" alt=""></td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->product_category}}</td>
                                        <td>{{$product->product_price}}</td>
                                         <td>
                                            @if ($product->status == 1)
                                            <label class="badge badge-success">Activé</label>
                                            @else
                                            <label class="badge badge-danger">Désactivé</label>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="window.location='{{URL::to('/edit_produit/'.$product->id)}}'">Edit</button>
                                            <button class="btn btn-outline-danger" onclick="window.location='{{URL::to('/delete_produit/'.$product->id)}}'">Delete</button>

                                            @if ($product->status == 1)
                                            <button class="btn btn-outline-warning" onclick="window.location='{{URL::to('/desactiver_produit/'.$product->id)}}'">Désactivé</button>
                                           @else
                                           <button class="btn btn-outline-warning" onclick="window.location='{{URL::to('/activer_produit/'.$product->id)}}'">Activé</button>

                                            @endif
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
