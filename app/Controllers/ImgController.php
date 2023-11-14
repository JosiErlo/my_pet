<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Services\ImagemService;

class ImgController extends Controller
{
    protected $imagemService;

    public function __construct()
    {
        $this->imagemService = new ImagemService();
    }

    public function uploadForm($postId)
    {
        // Adicione a lógica para salvar a imagem aqui
        if ($this->request->getMethod() === 'post') {
            $image = $this->request->getFile('imagem');
    
            if ($image && $image->isValid()) {
                $this->imagemService->saveImageForPost($postId, $image);
            }
        }
    
        // Adicione esta linha para depuração
        log_message('debug', 'Página de formulário de upload acessada.');
    
        $data['postId'] = $postId;
    
        return view('upload_form', $data);
    }
    
    public function visualizar_postagem($postId)
    {
        // Removido o redirecionamento automático
        // O redirecionamento será tratado explicitamente no formulário de upload
        return $this->uploadForm($postId);
    }

    // Restante do código...
}
 