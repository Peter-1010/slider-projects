@extends('layouts.app')

@section('content')
@if (session('deleted'))
    <div class="alert alert-success" role="alert">
        {{__('admin.deleted success')}}
    </div>
@endif
@if (session('created'))
    <div class="alert alert-success" role="alert">
        {{__('admin.created success')}}
    </div>
@endif
@if (session('updated'))
    <div class="alert alert-success" role="alert">
        {{__('admin.updated success')}}
    </div>
@endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Photo Title</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">{{__('admin.processes')}}</th>
            </tr>
            </thead>
            <tbody>

            @if(isset($products) && $products->count() > 0)
                @foreach($products as $product)
                    <?php
                        $productMainImage=json_decode($product->main_image1);
                    ?>
                    <tr>
                        <th scope="row">{{$product->id}}</th>
                        <td>
                            <?php if(false):?>
                            <img
                                src="{{url("/")."/".(is_null($productMainImage->path)?'#':$productMainImage->path)}}"
                                title="{{$productMainImage->title}}"
                                alt="{{$productMainImage->alt}}"
                                style="width: 150px">
                                <?php endif; ?>
                        </td>
                        <td></td>
                        <td>{{json_decode($product->title)->en}}</td>
                        <td>{{json_decode($product->description)->en}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                            <a href="{{route('admin.edit',$product->id)}}" class="btn btn-success">{{__('admin.edit')}}</a>
                            <a href="{{route('admin.delete',$product->id)}}" class="btn btn-danger">{{__('admin.delete')}}</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
@endsection

@extends('layouts.footer')

