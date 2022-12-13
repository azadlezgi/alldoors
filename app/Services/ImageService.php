<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{

    public static function resizeImageSize($image, $size, $quantity = 100)
    {

        $image = rawurldecode($image);

        $other_services = [
            'width' => 335,
            'height' => 225,
        ];

        $thumbnail = [
            'width' => 228,
            'height' => 153,
        ];

        $medium = [
            'width' => 355,
            'height' => 222,
        ];

        $large = [
            'width' => 724,
            'height' => 300,
        ];


        if (file_exists(public_path() . $image)) {


            $removeStrogaName = Str::after($image, '/storage/');
            $pathName = pathinfo($removeStrogaName, PATHINFO_DIRNAME);
            $otherServicesPathName = public_path('storage/cache-image/other_services/') . $pathName;
            $thumbnailPathName = public_path('storage/cache-image/thumbnail/') . $pathName;
            $mediumPathName = public_path('storage/cache-image/medium/') . $pathName;
            $largePathName = public_path('storage/cache-image/large/') . $pathName;


            if (!file_exists($otherServicesPathName)) {
                mkdir($otherServicesPathName, 0777, true);
            }

            if (!file_exists($thumbnailPathName)) {
                mkdir($thumbnailPathName, 0777, true);
            }

            if (!file_exists($mediumPathName)) {
                mkdir($mediumPathName, 0777, true);
            }

            if (!file_exists($largePathName)) {
                mkdir($largePathName, 0777, true);
            }

            if ($size == 'other_services') {

                $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
                $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
                $newFileName = $fileName . '-' . $other_services['width'] . 'x' . $other_services['height'] . '.' . $fileExtension;
                $lastFileName = '/storage/cache-image/other_services/' . $pathName . '/' . $newFileName;

                if (file_exists(public_path() . $lastFileName)) {
                    return $lastFileName;
                }

                $img = Image::make(public_path($image));
//                $img->crop($other_services['width'], $other_services['height']);
                $img->fit($other_services['width'], $other_services['height'], function ($constraint) {
//                    $constraint->upsize();
                });


                $img->save($otherServicesPathName . '/' . $newFileName, $quantity);


                return $lastFileName;

            }


            if ($size == 'thumbnail') {

                $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
                $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
                $newFileName = $fileName . '-' . $thumbnail['width'] . 'x' . $thumbnail['height'] . '.' . $fileExtension;
                $lastFileName = '/storage/cache-image/thumbnail/' . $pathName . '/' . $newFileName;

                if (file_exists(public_path() . $lastFileName)) {
                    return $lastFileName;
                }

                $img = Image::make(public_path($image));
//                $img->crop($thumbnail['width'], $thumbnail['height']);
                $img->fit($thumbnail['width'], $thumbnail['height'], function ($constraint) {
//                    $constraint->upsize();
                });


                $img->save($thumbnailPathName . '/' . $newFileName, $quantity);


                return $lastFileName;

            }


            if ($size == 'medium') {

                $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
                $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
                $newFileName = $fileName . '-' . $medium['width'] . 'x' . $medium['height'] . '.' . $fileExtension;
                $lastFileName = '/storage/cache-image/medium/' . $pathName . '/' . $newFileName;

                if (file_exists(public_path() . $lastFileName)) {
                    return $lastFileName;
                }

                $img = Image::make(public_path($image));
//                $img->crop($medium['width'], $medium['height']);
                $img->fit($medium['width'], $medium['height'], function ($constraint) {
//                    $constraint->upsize();
                });
                $img->save($mediumPathName . '/' . $newFileName, $quantity);


                return $lastFileName;

            }


            if ($size == 'large') {

                $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
                $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
                $newFileName = $fileName . '-' . $large['width'] . 'x' . $large['height'] . '.' . $fileExtension;
                $lastFileName = '/storage/cache-image/large/' . $pathName . '/' . $newFileName;

                if (file_exists(public_path() . $lastFileName)) {
                    return $lastFileName;
                }

                $img = Image::make(public_path($image));
//                $img->crop($large['width'], $large['height']);
                $img->fit($large['width'], $large['height'], function ($constraint) {
//                    $constraint->upsize();
                });
                $img->save($largePathName . '/' . $newFileName, $quantity);

                return $lastFileName;
            }
        } //file_exists()


        return $image;


    }

    public static function customImageSize($image, $width, $height, $quantity = 100)
    {

        $image = rawurldecode($image);


        if (file_exists(public_path('/') . $image)) {


            $removeStrogaName = Str::after($image, '/storage/');
            $pathName = pathinfo($removeStrogaName, PATHINFO_DIRNAME);
            $thumbnailPathName = public_path('storage/cache-image/custom/') . $pathName;


            if (!file_exists($thumbnailPathName)) {
                mkdir($thumbnailPathName, 0777, true);
            }


            $fileExtension = pathinfo($removeStrogaName, PATHINFO_EXTENSION);
            $fileName = pathinfo($removeStrogaName, PATHINFO_FILENAME);
            $newFileName = Str::slug($fileName, '-') . '-' . $width . 'x' . $height . '.' . $fileExtension;
            $lastFileName = '/storage/cache-image/custom/' . $pathName . '/' . $newFileName;

            if (file_exists(public_path() . $lastFileName)) {
                return $lastFileName;
            }

            $img = Image::make(public_path($image));
            $img->fit($width, $height, function ($constraint) {
//                    $constraint->upsize();
            });


            $img->save($thumbnailPathName . '/' . $newFileName, $quantity);


            return $lastFileName;


        } //file_exists()


        return $image;


    }

    public static function removeFiles()
    {
        Storage::deleteDirectory('public/cache-image');

    }

}
