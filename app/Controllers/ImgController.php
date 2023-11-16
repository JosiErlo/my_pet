<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Services\ImagemService;

class ImgController extends Controller
{
    protected $imagemService;

    // Construtor que recebe uma instância de ImagemService
    public function __construct(ImagemService $imagemService)
    {
        $this->imagemService = $imagemService;
    }

    // Método para exibir o formulário de upload de imagem
    public function upload_form($postId)
    {
        // Verifica se o método da requisição é POST
        if ($this->request->getMethod() === 'post') {
            // Obtém o arquivo de imagem do formulário
            $image = $this->request->getFile('imagem');

            // Verifica se a imagem é válida
            if ($image && $image->isValid()) {
                // Chama o serviço de imagem para salvar a imagem associada à postagem
                $uploadResult = $this->imagemService->saveImageForPost($postId, $image);

                // Verifica se o upload foi bem-sucedido
                if ($uploadResult) {
                    // Upload bem-sucedido, redireciona para visualizar a postagem
                    return redirect()->to(site_url("visualizar_postagem/$postId"));
                } else {
                    // Falha ao salvar a imagem, registra um erro e exibe uma mensagem
                    $error = $this->upload->display_errors();
                    log_message('error', 'Falha ao salvar a imagem: ' . $error);
                    echo 'Falha ao salvar a imagem. Verifique os logs para obter mais informações.';
                    // Adicione lógica de tratamento de erro aqui, se necessário
                }
            } else {
                // Nenhuma imagem válida fornecida, registra uma mensagem de depuração
                log_message('debug', 'Nenhuma imagem válida fornecida.');
                echo 'Nenhuma imagem válida fornecida.';
            }
        }

        // Adicione esta linha para depuração
        log_message('debug', 'Página de formulário de upload acessada.');

        // Dados a serem passados para a visão
        $data['postId'] = $postId;

        // Carrega a visão 'upload_form' com os dados
        return view('upload_form', $data);
    }

    // Método para visualizar a postagem
    public function visualizar_postagem($postId)
    {
        // Redireciona para o formulário de upload após visualizar a postagem
        return redirect()->to(site_url("upload_form/$postId"));
    }

}
