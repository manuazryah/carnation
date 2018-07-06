<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadFile
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use Imagine\Image\Box;

class UploadFile extends Component {

    public function UploadFile($model, $main_image, $path, $sizes) {
        if (file_exists($path)) {
            if (file_exists($path)) {
                $this->recursiveRemoveDirectory($path);
            }
            if ($main_image->saveAs($path . '/' . 'large.' . $main_image->extension)) {
                //$newpath = $path . '/';
                $this->ImageResize($sizes, $path, $model, $main_image);
            } else {
                return FALSE;
            }
        } else {
            FileHelper::createDirectory($path, $mode = 0775, $recursive = true);

            if ($main_image->saveAs($path . '/' . 'large.' . $main_image->extension)) {
                //$newpath = $path . '/';
                $this->ImageResize($sizes, $path, $model, $main_image);
            }
        }
    }

    public function ImageResize($sizes, $path, $model, $image) {

        foreach ($sizes as $size) {
            $savePath = $path . '/' . $size['name'] . '.' . $image->extension;

            $fileName = $path . '/' . 'large.' . $image->extension;

            $resized_image = $path . '/' . $size['name'] . '.' . $image->extension;
            if (file_exists($resized_image))
                unlink($resized_image);
            Image::getImagine()->open($fileName)->thumbnail(new Box($size['width'], $size['height']))->save($savePath, ['quality' => 90]);
            //unlink($fileName);
        }
    }

    function recursiveRemoveDirectory($directory) {
        foreach (glob("{$directory}/*") as $file) {
            if (is_dir($file)) {
                return true;
                //recursiveRemoveDirectory($file);
            } else {
                unlink($file);
            }
        }
    }

}
