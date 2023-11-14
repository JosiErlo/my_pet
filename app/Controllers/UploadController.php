<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload_form');
    }

    public function doUpload()
    {
        $upload = service('upload');

        if ($upload->doUpload('userfile')) {
            // Upload bem-sucedido
            $data = $upload->getData();

            // Agora você pode salvar a informação no banco de dados se desejar
            // $this->imagemModel->insert(['caminho_imagem' => 'uploads/' . $data['file_name']]);

            return redirect()->to('sucesso');
        } else {
            // Erro no upload
            $error = $upload->getError();
            echo $error;
        }
    }
}
