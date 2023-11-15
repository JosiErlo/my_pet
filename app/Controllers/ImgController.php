<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Services\ImagemService;

class ImgController extends Controller
{
    protected $imagemService;

    public function __construct(ImagemService $imagemService)
    {
        $this->imagemService = $imagemService;
    }

    public function upload_form($postId)
{
    if ($this->request->getMethod() === 'post') {
        $image = $this->request->getFile('imagem');

        if ($image && $image->isValid()) {
            $uploadResult = $this->imagemService->saveImageForPost($postId, $image);
            

            if ($uploadResult) {
                // Upload bem-sucedido
                return redirect()->to(site_url("visualizar_postagem/$postId"));
            } else {
                // Falha ao salvar a imagem
                $error = $this->upload->display_errors();
                log_message('error', 'Falha ao salvar a imagem: ' . $error);
                echo 'Falha ao salvar a imagem. Verifique os logs para obter mais informações.';
                // Adicione lógica de tratamento de erro aqui, se necessário
            }
        } else {
            // Nenhuma imagem válida fornecida
            log_message('debug', 'Nenhuma imagem válida fornecida.');
            echo 'Nenhuma imagem válida fornecida.';
        }
    }

    // Adicione esta linha para depuração
    log_message('debug', 'Página de formulário de upload acessada.');

    $data['postId'] = $postId;

    return view('upload_form', $data);
}

    
    public function visualizar_postagem($postId)
    {
        // Redirecione para o formulário de upload após visualizar a postagem
        return redirect()->to(site_url("upload_form/$postId"));
    }

    // Restante do código...
}
