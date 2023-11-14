<?php

namespace App\Services;

use App\Models\ImagemModel;

class ImagemService
{
    protected $imagemModel;

    public function __construct()
    {
        $this->imagemModel = new ImagemModel();
    }

    public function getImagensByPostId($postId)
    {
        return $this->imagemModel->where('post_id', $postId)->findAll();
    }

    public function saveImageForPost($postId, $image)
    {
        // Atribuição inicial das variáveis
        $destinationDirectory = FCPATH . 'public/assets/imgs/';
        $filename = '';
        $destinationPath = '';

        if ($image !== null && is_object($image) && method_exists($image, 'isValid') && $image->isValid() && !$image->hasMoved()) {
            $filename = uniqid() . '_' . $image->getName();
            $destinationPath = $destinationDirectory . $filename;
        }

        // Verifica se a imagem é válida
        if ($image !== null && is_object($image) && method_exists($image, 'isValid') && $image->isValid() && !$image->hasMoved()) {
            // Salva a imagem e retorna o caminho local
            return $this->saveImage($image, $postId);
        }

        return null;
    }
    
    

    private function saveImage($image, $postId)
{
    // Define o diretório de destino
    $destinationDirectory = FCPATH . 'public/assets/imgs/';

    // Gera um nome único para a imagem
    $filename = uniqid() . '_' . $image->getName();

    // Define o caminho de destino completo
    $destinationPath = $destinationDirectory . $filename;

    // Log da mensagem de caminho completo
    log_message('debug', 'Caminho Completo: ' . $destinationPath);

    // Simula o movimento da imagem sem realmente movê-la
    // Comente esta linha quando não estiver depurando
    // return $filename;

    // Move a imagem para o diretório de destino
    if ($image->move($destinationDirectory, $filename)) {
        // Salva o caminho completo da imagem no banco de dados associado ao post
        $this->imagemModel->insert([
            'post_id' => $postId,
            'caminho_imagem' => 'public/assets/imgs/' . $filename,
        ]);

        // Retorna o caminho completo local da imagem
        return $filename;
    }

    return null;
}

    
    

    
}
