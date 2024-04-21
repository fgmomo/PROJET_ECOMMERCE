@extends('layouts.appadmin')
@section('title')
Modifier Slider
@endsection
@section('content')

        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Modifier Slider</h4>
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
                  <form class="cmxform" id="commentForm" enctype="multipart/form-data" method="post" action="{{route('editSlider')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$sliders->id}}">
                      <div class="form-group">
                        <label for="cname">Description 1</label>
                        <input id="cname" value="{{$sliders->description1}}" class="form-control" name="description1"  type="text">
                      </div>
                      <div class="form-group">
                        <label for="cname">Description 2</label>
                        <input id="cname" value="{{$sliders->description2}}" class="form-control" name="description2" type="text" >
                      </div>

                      <div class="form-group">
                        <label for="cname">Image</label>
                        <input id="cname" class="form-control" name="slider_image" type="file"  >
                      </div>
                      <input class="btn btn-primary" type="submit" value="Modifier Slider">

                  </form>
                </div>
              </div>
            </div>
          </div>

@endsection

@section('script')

@endsection
