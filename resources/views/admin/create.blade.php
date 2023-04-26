@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title m-b-md">
                {{__('admin.add product')}}
                <button type='button' class="btn btn-primary add-slider">Add Slider</button>

            </div>
            <div id="form-content" class="main-slider">
                <form method="post" enctype="multipart/form-data" action="{{route('admin.insert')}}">
                    @csrf
                    <div class="row">
                        <div class="slide-column col-md-12">
                            <div id="slider-title"></div>
                            <div class="form-group">
                                <label for="image">Photo</label>
                                <input type="file" class="form-control" name="main">

                                <label for="alt">Alt</label>
                                <input type="text" class="form-control" name="alt">

                                <label for="title">Title</label>
                                <input type="text" class="form-control" name="title">

                                <br>

                                <button type='button' class="btn btn-primary add">Add</button>
                            </div>
                            <div class="add-content"></div>
                        </div>
                        <div class="new-slider"></div>
                    </div>
                    @if(!empty($lang_data) && count($lang_data) != 0)
                        @foreach($lang_data as  $lang)
                            <div class="form-group">
                                <label for="name_{{$lang}}">Name in {{strtoupper($lang)}}</label>
                                <input type="text" class="form-control" name="name[]">
                            </div>
                            <div class="form-group">
                                <label for="description_{{$lang}}">Description in {{strtoupper($lang)}}</label>
                                <input type="text" class="form-control" name="description[]">
                            </div>
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label for="price">{{__('admin.price')}}</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="quantity">{{__('admin.quantity')}}</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" max="500">
                    </div>
                    <button type="submit" class="btn btn-primary">{{__('admin.save')}}</button>
                </form>
            </div>

        </div>
    </div>
    <script>
        $(function () {
            $("body").on("click", ".add", function () {
                $(this).hide();
                $('.add-content').append(
                    "" +
                    "<div class='form-group parent'>" +
                    "    <label for= 'image'>Photo</label>" +
                    "    <input type='file' class='form-control' name='slide_image_new[]'>" +
                    "    <label for='alt'>Alt</label>" +
                    "    <input type='text' class='form-control' name='slide_alt_new[]'>" +
                    "    <label for='title'>Title</label>" +
                    "    <input type='text' class='form-control' name='slide_title_new[]'>" +
                    "    <br>" +
                    "    <button type='button' class='btn btn-danger delete-slide'>Delete</button>" +
                    "    </div>" +
                    "<button type='button' class='btn btn-primary add'>Add</button>");
            });

            $("body").on("click", ".delete-slide", function () {
                $(this).parent('.parent').remove();
            });

            $("body").on("click", ".add-slider", function () {
                $(this).remove();

                $('.new-slider').addClass('col-md-6');
                $('.slide-column').removeClass('col-md-12').addClass('col-md-6');

                $('#slider-title').html(
                    "<br>" +
                    "<h2 class='title'>Slider 1</h2>" +
                    "<br>"
                );

                $('.new-slider').append(
                    "<br>" +
                    "<h2 class='title'>Slider 2</h2>" +
                    "<br>" +
                    "<div class='form-group'>" +
                    "    <label for= 'image'>Photo</label>" +
                    "    <input type='file' class='form-control' name='slider_2_image'>" +
                    "    <label for='alt'>Alt</label>" +
                    "    <input type='text' class='form-control' name='slider_2_alt'>" +
                    "    <label for='title'>Title</label>" +
                    "    <input type='text' class='form-control' name='slider_2_title'>" +
                    "    <br>" +
                    "<button type='button' class='btn btn-primary new-slider-add'>Add</button>" +
                    "<div class='add-content-slider'></div>"
                );
            });


            $("body").on("click", ".new-slider-add", function () {
                $(this).hide();
                $('.new-slider').append(
                    "<div class='form-group parent'>" +
                    "    <label for= 'image'>Photo</label>" +
                    "    <input type='file' class='form-control' name='slide_image_add[]'>" +
                    "    <label for='alt'>Alt</label>" +
                    "    <input type='text' class='form-control' name='slide_alt_add[]'>" +
                    "    <label for='title'>Title</label>" +
                    "    <input type='text' class='form-control' name='slide_title_add[]'>" +
                    "    <br>" +
                    "    <button type='button' class='btn btn-danger delete-slide-new'>Delete</button>" +
                    "    </div>" +
                    "<button type='button' class='btn btn-primary new-slider-add'>Add</button>" +
                    "<br>");
            });
            $("body").on("click", ".delete-slide-new", function () {
                $(this).parent('.parent').remove();
            });
        });
    </script>

@endsection

@extends('layouts.footer')
