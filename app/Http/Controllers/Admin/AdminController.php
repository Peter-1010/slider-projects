<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Lang;
use App\Http\Models\Product;
use App\Http\Traits\UploadImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    use UploadImages;

    public function getAll(){

        $products =Product::getAllProducts();

        return view('admin.all', compact('products'));
    }

    public function create(){
        $lang_data = $this->getLangs();
        return view('admin.create', compact('lang_data'));
    }

    public function insert(Request $request){

        $main_one = $this->mainImage($request->main, $request->alt, $request->title, $request);
        $main_two = $this->mainImage($request->slider_2_image, $request->slider_2_alt, $request->slider_2_title, $request);

        $data_slide_one = $this->sliderImages($request, "slide_images1");
        $data_slide_two = $this->sliderImages($request->slide_image_add, $request->slide_alt_add, $request->slide_title_add, $request);

        $titles = $this->setTitles($request->name);
        $descriptions = $this->setDescriptions($request->description);

        Product::create([
            'main_image1'    => json_encode($main_one),
            'main_image2'    => json_encode($main_two),
            'slide_images1' => json_encode($data_slide_one),
            'slide_images2' => json_encode($data_slide_two),
            'title'         => json_encode($titles),
            'description'   => json_encode($descriptions),
            'price'         => $request->price,
            'quantity'      => $request->quantity,

        ]);


        return redirect()->route('admin.index')->with(['created'=>'']);
    }

    public function edit($product_id){

        $products  = DB::table('products')->where('id', $product_id)->get();
        $lang_data = $this->getLangs();
        return view('admin.edit', compact('products', 'lang_data'));
    }

    public function update(Request $request, $product_id){


        $main_one = $this->mainImageEdit($request->image, $request->hidden_image, $request->alt, $request->title, $request);

        if ($request->isAdd){
            $main_two = $this->mainImage($request->slider_2_image, $request->slider_2_alt, $request->slider_2_title, $request);
        }else {
            $main_two = $this->mainImageEdit($request->slide_image_new, $request->hidden_image2, $request->slide_alt_new, $request->slide_title_new, $request);
        }
//        dd($main_two);


        $data_slide_one = $this->slideImageEdit(
            $request->slide_images1_images,
            $request->slide_images1_alt,
            $request->slide_images1_title,

            $request->slide_images1_hidden_slide_image,
            $request->slide_images1_old_slide_alt,
            $request->slide_images1_old_slide_title,
            $request
        );

        $data_slide_two = $this->slideImageEdit(
            $request->slide_images2_images,
            $request->slide_images2_alt,
            $request->slide_images2_title,

            $request->slide_images2_hidden_slide_image,
            $request->slide_images2_old_slide_alt,
            $request->slide_images2_old_slide_title,
            $request
        );


        $titles = $this->setTitles($request->name);
        $descriptions = $this->setDescriptions($request->description);

        $product = DB::table('products')->where('id', $product_id)->update([
            'main_image1'   => json_encode($main_one),
            'main_image2'   => json_encode($main_two),
            'slide_images1' => json_encode($data_slide_one),
            'slide_images2' => json_encode($data_slide_two),
            'title'         => json_encode($titles),
            'description'   => json_encode($descriptions),
            'price'         => $request->price,
            'quantity'      => $request->quantity,
        ]);

        return redirect()->route('admin.index')->with(['updated'=>'']);
    }

    public function delete($product_id){
        $product = Product::find($product_id);

        if($product->delete()){
            return redirect()->back()->with(['deleted'=>'']);
        }
    }

    public function lang(){
        $langs = DB::table('langs')->select('lang_title')->get();
        return $langs;
    }


    private function getLangs(){
        $lang_data = [];
        $langs = DB::table('langs')->select('lang_title')->get();
        foreach ($langs as $key => $lang){
            $lang_data[$key] = $lang->lang_title;
        }

        return $lang_data;
    }

    private function setTitles($dataTitles){
        $lang_data = $this->getLangs();

        $titles = [];

        foreach ($lang_data as $key => $lang){
            $titles[$lang] = $dataTitles[$key];
        }
        return $titles;
    }

    private function setDescriptions($dataDescriptions){
        $lang_data = $this->getLangs();

        $descriptions = [];

        foreach ($lang_data as $key => $lang){
            $descriptions[$lang] = $dataDescriptions[$key];
        }
        return $descriptions;
    }

    private function sliderImages(Request $request, $sliderKey){

        if (!$request->hasFile($sliderKey.'_images')) {
            return null;
        }


        $slide_image = $request->file($sliderKey.'_images');
        $slide_alt = $request->get($sliderKey."_alt");
        $slide_title = $request->get($sliderKey."_title");

        $data = [];
        foreach ($slide_alt as $key => $alt) {
            $data[] = [
                "alt" => $slide_alt[$key],
                "title" => $slide_title[$key],
                "path" => $this->upload($slide_image[$key]),
            ];
        }

        return $data;

    }

    private function mainImage($main, $alt, $title, Request $request){
        $main_one = [];
        if (!empty($main)) {
            $main_one['alt']   = $alt;
            $main_one['title'] = $title;
            $main_one['path'] = $this->upload($main);
            return $main_one;
        }else{
            return NULL;
        }
    }

    private function mainImageEdit($main, $hiddenKey, $alt, $title, Request $request){
        if ($hiddenKey == NULL && $main == NULL){
            return NULL;
        }
        if ($main !== NULL){
            $main_image = $this->mainImage($main, $alt, $title, $request);
        }else{
            $main_image = [
                "alt" => $alt,
                "title" => $title,
                "path" => $hiddenKey
            ];
        }
        return $main_image;
    }


}
