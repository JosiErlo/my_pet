<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UploadController extends Controller
{
    // Método para exibir o formulário de upload
    public function index()
    {
        return view('upload_form');
    }

    // Método para realizar o upload de um arquivo
    public function doUpload()
    {
        // Obtenha o serviço de upload
        $upload = service('upload');

        // Verifique se o upload foi bem-sucedido
        if ($upload->doUpload('userfile')) {
            // Upload bem-sucedido
            $data = $upload->getData();

            // Agora você pode salvar a informação no banco de dados se desejar
            // $this->imagemModel->insert(['caminho_imagem' => 'uploads/' . $data['file_name']]);

            // Redirecione para a página de sucesso
            return redirect()->to('sucesso');
        } else {
            // Erro no upload
            $error = $upload->getError();
            echo $error; // Exiba o erro (pode ser mais apropriado lidar com o erro de forma mais elegante)
        }
    }
}
