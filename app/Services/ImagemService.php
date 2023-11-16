<?php

namespace App\Services;

use App\Models\ImagemModel;

class ImagemService
{
    protected $imagemModel;

    // Construtor da classe ImagemService, recebe uma instância de ImagemModel.
    public function __construct(ImagemModel $imagemModel)
    {
        $this->imagemModel = $imagemModel;
    }

    // Método para obter imagens por ID de postagem.
    public function getImagensByPostId($postId)
    {
        return $this->imagemModel->where('post_id', $postId)->findAll();
    }

    // Método para salvar uma imagem para uma postagem.
    public function saveImageForPost($postId, $image)
    {
        // Verifica se a imagem é válida antes de tentar salvá-la.
        if ($this->isValidImage($image)) {
            return $this->saveImage($image, $postId);
        }

        return null;
    }

    // Método privado para verificar se uma imagem é válida.
    private function isValidImage($image)
    {
        return $image !== null && is_object($image) && method_exists($image, 'isValid') && $image->isValid() && !$image->hasMoved();
    }

    // Método privado para salvar uma imagem no servidor e registrar no banco de dados.
    private function saveImage($image, $postId)
    {
        // Define o diretório de destino para salvar a imagem.
        $destinationDirectory = '/assets/imgs/';

        // Gera um nome de arquivo único para evitar conflitos.
        $filename = uniqid() . '_' . $image->getName();

        // Define o caminho completo da imagem no servidor.
        $destinationPath = $destinationDirectory . $filename;

        // Move a imagem para o diretório de destino.
        if ($image->move($destinationDirectory, $filename)) {
            // Insere as informações da imagem no banco de dados.
            $this->imagemModel->insert([
                'post_id' => $postId,
                'caminho_imagem' => '/assets/imgs/' . $filename,
            ]);

            // Retorna o nome do arquivo como indicação de sucesso.
            return $filename;
        }

        // Retorna null em caso de falha no movimento da imagem.
        return null;
    }
}
