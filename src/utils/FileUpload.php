<?php

namespace utils;

use Cloudinary\Cloudinary;
use Dotenv\Dotenv;
use Exception;

class FileUpload
{
    private static $storage;

    private static function getStorage()
    {
        if (self::$storage === null) {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
            $dotenv->load();
            self::$storage = new Cloudinary($_ENV['CLOUDINARY_URL']);
        }
        return self::$storage;
    }

    public static function uploadImagem($pasta, $imagem, $idPublico)
    {
        try {
            $uploadAPI = self::getStorage()->uploadApi();
            $result = $uploadAPI->upload($imagem, [
                'folder' => $pasta,
                'public_id' => $idPublico,
                'overwrite' => true,
                'resource_type' => 'image'
            ]);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Erro no upload da imagem: " . $e->getMessage());
        }
    }

    public static function deletarImagem($pasta, $publicUrl)
    {
        try {
            $uploadAPI = self::getStorage()->uploadApi();
            $publicId = $pasta . "/" . pathinfo($publicUrl, PATHINFO_FILENAME);
            $result = $uploadAPI->destroy($publicId, ['resource_type' => 'image']);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Erro ao deletar a imagem: " . $e->getMessage());
        }
    }
}