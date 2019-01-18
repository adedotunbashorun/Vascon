<?php

namespace Modules\Movies\Helpers;
use JD\Cloudder\Facades\Cloudder;

class ImageClass
{
    //image upload
    public function image_upload($image)
    {
        // $this->validate($image,[
        //     'image_name'=>'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
        // ]);

        if(isset($image)) {
            $image_name = $image->getRealPath();
            Cloudder::upload($image_name, null);
            list($width, $height) = getimagesize($image_name);
            $image_url= Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);

            return $image_url;
        }

    }

}
