
<div class="form-group col-md-4 main_slider_parent_div">
    <h2 class="title">{{$sliderTitle}}</h2>

    <div class='form-group slider_item_parent origin_add_image_at_slider'>
        <label for= 'image'>Add Image</label>
        <br>
        <img src='http://myamazon.com/resources/images/add-image.png' alt='Add Image' style='width: 150px'>
        <input type='file' class='form-control' name='{{$fieldName}}_images[]'>
        <label for='alt'>Alt</label>
        <input type='text' class='form-control' name='{{$fieldName}}_alt[]'>
        <label for='title'>Title</label>
        <input type='text' class='form-control' name='{{$fieldName}}_title[]'>
        <br>
        <button type='button' class='btn btn-danger delete_slider_item'>Delete</button>
    </div>
    <button type='button' class='btn btn-primary add_slider_item'>Add</button>

    <div class="add-content"></div>


    <br>
    @if(isset($product->{$fieldName}) && json_decode($product->{$fieldName}) !== NULL)
        @foreach(json_decode($product->{$fieldName}) as $key=>$alt)
            <div class="form-group slider_item_parent">
                <label for="image">Photo</label><br>
                <img
                    src="{{url(json_decode($product->{$fieldName})[$key]->path)}}"
                    title="{{json_decode($product->{$fieldName})[$key]->title}}"
                    alt="{{json_decode($product->{$fieldName})[$key]->alt}}"
                    style="width: 150px" class="img-thumbnail">


                <input
                        type="file" class="form-control"
                        name="{{$fieldName}}_old_slide_images[]">

                <input type="hidden"
                       name="{{$fieldName}}_hidden_slide_image[{{$key}}]"
                       value="{{json_decode($product->{$fieldName})[$key]->path}}">

                <label for="alt">Alt</label>
                <input type="text" class="form-control"
                       name="{{$fieldName}}_old_slide_alt[]"
                       value="{{json_decode($product->{$fieldName})[$key]->alt}}">

                <label for="title">Title</label>
                <input type="text" class="form-control"
                       name="{{$fieldName}}_old_slide_title[]"
                       value="{{json_decode($product->{$fieldName})[$key]->title}}">

                <br>
                <?php if(!empty($product->{$fieldName})):?>
                    <button type='button' class='btn btn-danger delete_slider_item'>Delete
                    </button>
                <?php endif; ?>
            </div>
        @endforeach
    @endif
</div>
