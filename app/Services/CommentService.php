<?php
// CommentService.php
namespace App\Services;

use App\Entities\Comment;
use App\Models\CommentModel;
use App\Models\UserModel;

class CommentService
{
    protected $commentModel;
    protected $userModel;

    // Construtor da classe CommentService.
    public function __construct()
    {
        // Inicializa as instâncias dos modelos necessários.
        $this->commentModel = new CommentModel();
        $this->userModel = new UserModel();
    }

    // Método para criar um novo comentário.
    public function createComment($commentData)
    {
        // Cria uma instância da entidade Comment a partir dos dados fornecidos.
        $comment = new Comment($commentData);

        // Insere o comentário no banco de dados usando o modelo CommentModel.
        return $this->commentModel->insert($comment);
    }

    // Método para excluir um comentário pelo ID.
    public function selfDelete($id)
    {
        // Exclui o comentário do banco de dados usando o modelo CommentModel.
        return $this->commentModel->delete($id);
    }

    // Método para obter a senha de um usuário pelo email.
    public function getUserByEmail($email)
    {
        // Consulta o modelo UserModel para obter a senha do usuário com o email fornecido.
        $user = $this->userModel->select('password')->where('email', $email)->first();

        // Retorna a senha do usuário, se encontrado, ou null caso contrário.
        return $user ? $user->password : null;
    }
}
