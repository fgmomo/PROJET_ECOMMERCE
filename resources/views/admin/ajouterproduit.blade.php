@extends('layouts.appadmin')
@section('title')
add Produit
@endsection
@section('content')

        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter Produit</h4>
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
                  <form class="cmxform" enctype="multipart/form-data" id="commentForm" method="post" action="{{route('sauver_produit')}}">
                    @csrf
                      <div class="form-group">
                        <label for="cname">Nom du Produit</label>
                        <input id="cname" class="form-control" name="product_name" type="text"  >
                      </div>
                      <div class="form-group">
                        <label for="cname">Prix du Produit</label>
                        <input id="cname" class="form-control" name="product_price"  type="text" >
                      </div>
                      <div class="form-group">
                        <label for="categorieProduit">Catégorie du Produit</label>
                        <select id="categorieProduit" class="form-control" name="product_category" >
                            <option >Selectionez la catégorie</option>
                            @foreach ($categorie as $category )
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                      <div class="form-group">
                        <label for="cname">Image du Produit</label>
                        <input id="cname" class="form-control" name="product_image" type="file">
                      </div>
                      <input class="btn btn-primary" type="submit" value="Ajouter">

                  </form>
                </div>
              </div>
            </div>
          </div>


@endsection

@section('script')

@endsection
