<?php
/**
 * UPLOAD FILES
 * User: SuprunAK
 * Date: 21.09.2020
 * Time: 11:22
 */

namespace App\Helpers;


class Upload
{
    private static $dir_main = 'files';

    /**
     * Сохранение файла(ов) или IMG base64
     * @param string $path Относительно базового каталога
     * @param mixed $file
     * @return array
     */
    public static function saveFile($path, $file,$name_file='')
    {

        $full_path = base_path()  . DIRECTORY_SEPARATOR . self::$dir_main . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR;
        $full_path = str_replace('..', '', $full_path);
        $full_path = str_replace('//', DIRECTORY_SEPARATOR, $full_path);
        $path = $path.DIRECTORY_SEPARATOR;
        $path = str_replace('//', DIRECTORY_SEPARATOR, $path);
        //print_r($full_path);die;
        //Создаём директорию если её нет
        if (!is_dir($full_path))
            mkdir($full_path, 0777, true);
        $out = null;
        //var_dump($file);die;
        if (isset($file['name'])) {
            //Массив файлов
            if (is_array($file['name'])) {
                foreach ($file["error"] as $key => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $tmp_name = $file["tmp_name"][$key];
                        $path_parts = pathinfo($file["name"][$key]);
                        $name = $path_parts['basename'];
                        $fileName =$name_file;
                        if ($name_file=='')
                            $fileName = self::newName($full_path, $path_parts['extension']);
                        move_uploaded_file($tmp_name, $full_path . $fileName);
                        $out[] = ["name" => $name, "file" => $path.$fileName,"size"=>$file['size'][$key]];
                    }
                }
            } else {
                if ($file["error"] == UPLOAD_ERR_OK) {
                    $tmp_name = $file["tmp_name"];
                    $path_parts = pathinfo($file["name"]);
                    $name = $path_parts['basename'];
                    $fileName =$name_file;
                    if ($name_file=='')
                        $fileName = self::newName($full_path, $path_parts['extension']);
                    move_uploaded_file($tmp_name, $full_path . $fileName);
                    $out[] = ["name" => $name, "file" => $path.$fileName,"size"=>$file['size']];
                }
            }
        } else if (preg_match("/data:image\/(?<extension>(?:png|gif|jpg|jpeg));base64,(?<image>.+)/", $file, $matchings)) {
            $imageData = base64_decode($matchings['image']);
            $extension = $matchings['extension'];
            $name = sprintf("image.%s", $extension);
            $fileName =$name_file;
            if ($name_file=='')
                $fileName = self::newName($full_path, $extension);
            if (file_put_contents($full_path.$fileName, $imageData)) {
                $out[] = ["name" => $name, "file" => $path.$fileName,"size"=>100];
            }
        }

        return $out;
    }

    /**
     * Рекурсивная функция получения уникального имени файла в каталоге
     * @param $path
     * @param $ext
     * @return string
     */
    private static function newName($path, $ext)
    {
        $name = Tokens::getToken([3, 2, 2, 4]) . '.' . $ext;
        if (file_exists($path . $name)) {
            return self::newName($path, $ext);
        }
        return $name;
    }


    public static function deleteFile($file){
        $full_path =  base_path()  . DIRECTORY_SEPARATOR . self::$dir_main . DIRECTORY_SEPARATOR .$file;
        if (file_exists($full_path)){
            unlink($full_path);
        }
    }

    /**
     * Получить расширение файла
     * @param $filename
     * @return string
     */
    public static function getExtension($filename) {
        $tmp=explode(".", $filename);
        return strtolower(end($tmp));
    }

}