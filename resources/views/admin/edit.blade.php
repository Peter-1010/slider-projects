@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title m-b-md">
                {{__('admin.edit product')}}
            </div>
            @if(isset($products) && $products->count() > 0)
                @foreach($products as $product)
                    @if(json_decode($product->main_image2) == NULL)
                        <button type='button' class="btn btn-primary add-slider">Add Slider</button>
                        <br>
                    @endif

                    <form method="post" enctype="multipart/form-data" action="{{url('admin/update/'.$product->id)}}">
                        @csrf

                        <div class="row">

                            <?php if(false):?>
                                <div class="col-md-12">
                                    <label for="image">Main Image</label> <br>
                                    <img
                                        src="{{url("/")."/".(is_null($productMainImage->path)?'#':$productMainImage->path)}}"
                                        title="{{$productMainImage->title}}"
                                        alt="{{$productMainImage->alt}}" style="width: 150px" class="img-thumbnail">

                                    <input type="file" class="form-control" id="image" name="image">
                                    <input type="hidden" name="hidden_image" value="{{($productMainImage->path)}}">

                                    <label for="alt">Alt</label>
                                    <input type="text" class="form-control" name="alt"
                                           value="{{$productMainImage->alt}}">

                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="title"
                                           value="{{$productMainImage->title}}">
                                </div>
                            <?php endif; ?>


                            <?php
                                $sliderTitle = "slider 1";
                                $fieldName   = "slide_images1";
                            ?>
                            @include("admin.slider")


                            <?php
                                $sliderTitle = "slider 2";
                                $fieldName   = "slide_images2";
                            ?>
                            @include("admin.slider")

                            <?php
                                $sliderTitle = "slider 3";
                                $fieldName   = "slide_images3";
                            ?>
                            @include("admin.slider")



                        </div>


                        @if(!empty($lang_data) && count($lang_data) != 0)
                            @foreach($lang_data as  $lang)
                                <div class="form-group">
                                    <label for="name_{{$lang}}">Name in {{strtoupper($lang)}}</label>
                                    <input type="text" class="form-control" name="name[]"
                                           value="{{!empty(json_decode($product->title)->$lang) ? json_decode($product->title)->$lang : '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="description_{{$lang}}">Description in {{strtoupper($lang)}}</label>
                                    <input type="text" class="form-control" name="description[]"
                                           value="{{!empty(json_decode($product->description)->$lang) ? json_decode($product->description)->$lang : '' }}">
                                </div>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <label for="price">{{__('admin.price')}}</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">{{__('admin.quantity')}}</label>
                            <input type="text" class="form-control" id="quantity" name="quantity"
                                   value="{{$product->quantity}}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('admin.save')}}</button>
                    </form>
                    <br>
                @endforeach
            @endif
        </div>
    </div>
    <script>
        $(function () {
            $("body").on("click", ".add_slider_item", function () {
                var parentElement = $(this).parents(".main_slider_parent_div");

                var clonedHtml = $(".origin_add_image_at_slider", parentElement).first().clone();
                $("input", clonedHtml).val("");

                $('.add-content', parentElement).append(clonedHtml);
            });


            $("body").on("click", ".delete_slider_item", function () {
                $(this).parents('.slider_item_parent').remove();
            });

        });
    </script>
@endsection
@extends('layouts.footer')
