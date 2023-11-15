<?php

namespace App\Services;

use App\Models\ImagemModel;

class ImagemService
{
    protected $imagemModel;

    public function __construct(ImagemModel $imagemModel)
    {
        $this->imagemModel = $imagemModel;
    }

    public function getImagensByPostId($postId)
    {
        return $this->imagemModel->where('post_id', $postId)->findAll();
    }

    public function saveImageForPost($postId, $image)
    {
        if ($this->isValidImage($image)) {
            return $this->saveImage($image, $postId);
        }

        return null;
    }

    private function isValidImage($image)
    {
        return $image !== null && is_object($image) && method_exists($image, 'isValid') && $image->isValid() && !$image->hasMoved();
    }

    private function saveImage($image, $postId)
    {
        $destinationDirectory = '/assets/imgs/';
        $filename = uniqid() . '_' . $image->getName();
        $destinationPath = $destinationDirectory . $filename;

        if ($image->move($destinationDirectory, $filename)) {
            $this->imagemModel->insert([
                'post_id' => $postId,
                'caminho_imagem' => '/assets/imgs/' . $filename,
            ]);

            return $filename;
        }

        return null;
    }
}
