@extends('layouts.appadmin')
@section('tile')
    Slider
@endsection
@section('content')

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sliders</h4>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="order-listing" class="table" da>
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Image</th>
                                        <th>Description One</th>
                                        <th>Description Two</th>

                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                {{$increment = 1}}
                                <tbody>

                                    @foreach ($sliders as $slider )
                                    <tr>
                                        <td>{{$increment}}</td>
                                        <td><img src="storage/slider_images/{{$slider->slider_image}}" alt=""></td>
                                        <td>{{$slider->description1}}</td>
                                        <td>{{$slider->description2}}</td>
                                        <td>
                                            @if ($slider->status == 1)
                                            <label class="badge badge-success">Activé</label>
                                            @else
                                            <label class="badge badge-danger">Désactivé</label>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary" onclick="window.location='{{URL::to('/edit_slider/'.$slider->id)}}'">Edit</button>
                                            <button class="btn btn-outline-danger" onclick="window.location='{{URL::to('/delete_slider/'.$slider->id)}}'">Delete</button>

                                            @if ($slider->status == 1)
                                            <button class="btn btn-outline-warning" onclick="window.location='{{URL::to('/desactiver_slider/'.$slider->id)}}'">Désactivé</button>
                                           @else
                                           <button class="btn btn-outline-warning" onclick="window.location='{{URL::to('/activer_slider/'.$slider->id)}}'">Activé</button>

                                            @endif
                                        </td>
                                    </tr>

                                    <input type="hidden" value="{{$increment = $increment+1}}">
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
