<?php
declare(strict_types=1);

/**
 * @author Artuikh Vladimir
 * @copyright 2021 Artuikh Vladimir, vladimir.artjukh@gmail.com
 */

namespace App\Services\Image;

use App\Services\Image\Settings;
use Intervention\Image\Facades\Image;

class Images implements ImageInterface
{
    /**
     * @param  mixed[]  $imageParams
     */
    public function saveImage(array $imageParams)
    {
        if ($imageParams['file'] != '') {
            //Create folders
            $this->createDir($imageParams['object'], (string)$imageParams['id']);
            $settings = Settings::setting();
            foreach ($settings[$imageParams['object']] as $setting) {
                if ($imageParams['object']) {
                    //Save image
                    $this->fit($imageParams, $setting);
                }
            }
        }
    }

    //Created new folders

    /**
     * @param  string  $object  name folder
     * @param  string  $id  id into DB
     */
    public function createDir(string $object, string $id)
    {
        if (!is_dir(public_path().'/storage/')) {
            mkdir(public_path().'/storage/');
        }
        if (!is_dir(public_path().'/storage/'.$object)) {
            mkdir(public_path().'/storage/'.$object);
        }

        if (!is_dir(public_path().'/storage/'.$object.'/'.$id)) {
            mkdir(public_path().'/storage/'.$object.'/'.$id);
        }
    }

    /**
     * @param  array  $imageParams
     * @param  array  $setting
     *
     * @return array[]|\Intervention\Image\Image|mixed
     */
    public function fit(array $imageParams, array $setting)
    {
        $object  = $imageParams['object'];
        $id      = $imageParams['id'];
        $nameImg = $imageParams['name_img'];
        $file    = $imageParams['file'];
        $folder  = $setting['folder'];
        $width   = $setting['width'];
        $height  = $setting['height'];
        $quality = $setting['quality'];

        //Create folder
        if (!is_dir(public_path().'/storage/'.$object.'/'.$id.'/'.$folder)) {
            mkdir(public_path().'/storage/'.$object.'/'.$id.'/'.$folder);
        }
        //path to the image
        $pathImgFull = public_path().'/storage/'.$object.'/'.$id.'/'.$folder.'/'
            .$nameImg;
        if ($file != "") {

            try {
                //edit image
                $img = Image::make($file);
                if ($width != '' || $height != '') {
                    $img->resize($width, $height, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->resizeCanvas($width, $height);
                }
                $img->save($pathImgFull, $quality);

                return $img;
            } catch (\Exception $ex) {
                return [
                    'errors' => ['error' => $ex->getMessage()]
                ];
            }
        }
    }
}
