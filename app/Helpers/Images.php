<?php
/**
 * Created by PhpStorm.
 * User: SuprunAK
 * Date: 18.04.2018
 * Time: 11:22
 */

namespace App\Helpers;


use BenMajor\ImageResize\Image;
use BenMajor\ImageResize\Watermark;

class Images
{
    public static $cashed = true;
    //Добавлять водяной знак
    private static $isWatermark = false;
    private static $dir_img = 'files';
    private static $isCache = true;
    private static $dir_imgtmp = 'files/imgtmp';
    private static $is_croup = true;
    private static $jpeg_quality = 70; /* качество изоображения */


    public static function getImg($img_src, $param)
    {

        $imageSrc = base_path() . DIRECTORY_SEPARATOR . self::$dir_img . DIRECTORY_SEPARATOR . $img_src;
        $imageSrc = str_replace('//', DIRECTORY_SEPARATOR, $imageSrc);
        $cr_dir = false;
        if (is_file($imageSrc)) {
            $src = $imageSrc;
            $cr_dir = true;
        } else {
            $src = base_path() . '/files/none.png';
            $img_src = 'none.jpg';
        }

        //Если заапрошен оригинал изображения
        $params = explode('_', $param);
        if ($params[0] == 'origin') {
            self::output($src);
        }
        //Если включено сохранение обработанных фото
        if (self::$isCache && self::$dir_imgtmp != '') {
            $imageTmp = base_path() . DIRECTORY_SEPARATOR . self::$dir_imgtmp . DIRECTORY_SEPARATOR .
                $param . DIRECTORY_SEPARATOR .
                $img_src;
            if (is_file($imageTmp)) {
                self::output($imageTmp);
            } else if ($cr_dir) {
                if (!is_dir(pathinfo($imageTmp, PATHINFO_DIRNAME)))
                    mkdir(pathinfo($imageTmp, PATHINFO_DIRNAME), 0777, true);
            }
        }


        header("Content-type: image/jpeg");
        $size = getimagesize($src);
        switch ($size["mime"]) {
            case "image/jpeg":
                $source = imagecreatefromjpeg($src); //jpeg file
                break;
            case "image/gif":
                $source = imagecreatefromgif($src); //gif file
                break;
            case "image/png":
                $source = imagecreatefrompng($src); //png file
                break;
            default:
                $source = imagecreatefromjpeg($src);
                break;
        }

        $orig_w = imagesx($source);
        $orig_h = imagesy($source);

        $eaW = false;
        $eaWH = false;

        if ($params[0] == 'auto') {
            $wmax = round($params[1] / $orig_h * $orig_w);
        } else {
            $wmax = $params[0];
            $eaW = true;
        }
        if (isset($params[1]))
            if ($params[1] == 'auto') {
                $hmax = round($params[0] / $orig_w * $orig_h);
            } else {
                $hmax = $params[1];
                if ($eaW) $eaWH = true;
            }

        if ($orig_w > $wmax || $orig_h > $hmax) {
            $thumb_w = $wmax;
            $thumb_h = $hmax;
            if ($thumb_w / $orig_w * $orig_h > $thumb_h)
                $thumb_w = round($thumb_h * $orig_w / $orig_h);
            else
                $thumb_h = round($thumb_w * $orig_h / $orig_w);
        } else {
            $thumb_w = $orig_w;
            $thumb_h = $orig_h;
        }

        if ($eaWH) {
            $otnSet = $params[0] / $params[1];
            $otnOrg = $orig_w / $orig_h;
            if (self::$is_croup) {
                if ($otnSet > $otnOrg) {
                    $thumb_h2 = round($params[0] * $orig_h / $orig_w);
                    $thumb_w2 = $params[0];
                } else {
                    $thumb_w2 = round($params[1] * $orig_w / $orig_h);
                    $thumb_h2 = $params[1];
                }
            } else {
                if ($otnSet > $otnOrg) {
                    $thumb_h2 = $params[1];
                    $thumb_w2 = round($params[1] * $orig_w / $orig_h);
                } else {
                    $thumb_w2 = $params[0];
                    $thumb_h2 = round($params[0] * $orig_h / $orig_w);
                }
            }

            $thumb_h = $thumb_h2;
            $thumb_w = $thumb_w2;
        }
        imageinterlace($source, 0);
        $thumb = imagecreatetruecolor($wmax, $hmax);
        imageinterlace($thumb, 0);
        $white = imagecolorallocate($thumb, 255, 255, 255);

        imagefilledrectangle($thumb, 0, 0, $wmax - 1, $hmax - 1, $white);
        imagecopyresampled($thumb, $source,
            round(($wmax - $thumb_w) / 2), round(($hmax - $thumb_h) / 2),
            0, 0, $thumb_w, $thumb_h, $orig_w, $orig_h);

        $watermark = base_path() . '/files/imgtmp/watermark.png';

        if (is_file($watermark) && self::$isWatermark) {
            $filePng = imagecreatefrompng($watermark);
            $watermark_w = imagesx($filePng);
            $watermark_h = imagesy($filePng);
            if ($thumb_w >= $thumb_h) {
                imagecopyresampled($thumb, $filePng, floor(($thumb_w - $thumb_h) / 2), 0, 0, 0, $thumb_h, $thumb_h, $watermark_w, $watermark_h);
            } else {
                imagecopyresampled($thumb, $filePng, 0, floor(($thumb_h - $thumb_w) / 2), 0, 0, $thumb_w, $thumb_w, $watermark_w, $watermark_h);
            }
        }
        imagedestroy($source);
        imageinterlace($thumb, 0);
        if ($cr_dir && self::$isCache && self::$dir_imgtmp != '') {
            imagejpeg($thumb, $imageTmp, self::$jpeg_quality);
        }
        imagejpeg($thumb, null, self::$jpeg_quality);
        imagedestroy($thumb);
    }

    /**
     * Создание URL изображения
     * @param string $img
     * @param string $param  возможные значения: origin-оригинал, width_height-высота и ширина вместо одного значения можно применить параметр auto
     * @return string
     *
     */
    public static function getUrl($img, $param='origin')
    {
        return /*URL_BASE . */'/data/img/' . $param . '/' . $img;
    }


    private static function output($src)
    {
        $fp = fopen($src, 'rb');
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($src));
        fpassthru($fp);
        exit;
    }

}