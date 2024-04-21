@extends('layouts.appadmin')
@section('tile')
    Produit
@endsection
@section('content')

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
                                        <th>Nom du Client</th>
                                        <th>Adresse</th>
                                        <th>Panier</th>
                                        <th>Payment id</th>

                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>

                                        <td>1</td>
                                        <td>2012/08/03</td>
                                        <td>1</td>
                                        <td>2012/08/03</td>


                                        {{-- <td>
                                            <label class="badge badge-info">On hold</label>
                                        </td> --}}
                                        <td>
                                            <button class="btn btn-outline-primary">View</button>
                                            <button class="btn btn-outline-danger">Delete</button>
                                        </td>
                                    </tr>



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
