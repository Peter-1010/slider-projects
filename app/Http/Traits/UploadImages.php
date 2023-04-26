<?php


namespace App\Http\Traits;


use Illuminate\Http\Request;

trait UploadImages
{

    public function upload($photo){

        $file_extension = $photo->getClientOriginalExtension();
        $random_number  = rand(1,999999);
        $file_name      = $random_number.time().'.'.$file_extension;
        $path = 'images';
        $photo->move($path, $file_name);

        return $path.DIRECTORY_SEPARATOR.$file_name;

    }

    public function getFileExtension($photo){

        $file_extension = $photo->getClientOriginalExtension();

        return '.'.$file_extension;

    }

    private function array_default_key($array) {
        $arrayTemp = array();
        $i = 0;
        foreach ($array as $key => $val) {
            $arrayTemp[$i] = $val;
            $i++;
        }
        return $arrayTemp;
    }


    public function slideImageEdit(
        $main,
        $newAlt,
        $newTitle,

        $hiddenKey,
        $oldAlt,
        $oldTitle,

        Request $request
    ){

        if ($hiddenKey == NULL && $main == NULL){
            return NULL;
        }

        $old_slide_data = [];
        $new_slide_data = [];
        if ($hiddenKey !== NULL){
            $request_data = $this->array_default_key($hiddenKey);
            foreach ($request_data as $key => $value) {
                $old_slide_data[] = [
                    "alt" => $oldAlt[$key],
                    "title" => $oldTitle[$key],
                    "path" => $request_data[$key],
                ];
            }
        }
        $data = $old_slide_data;

        if (!empty($main)) {
            foreach ($main as $key => $value) {
                $data[] = [
                    "alt" => $newAlt[$key],
                    "title" => $newTitle[$key],
                    "path" => $this->upload($main[$key]),
                ];
            }
        }

        return $data;
    }

}
