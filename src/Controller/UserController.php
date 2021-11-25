<?php

namespace App\Controller;


use App\Model\UserManager;
use App\Service\UserFormValidator;

class UserController extends AbstractController
{
    public function add(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formValidator = new UserFormValidator($_POST);
            $formValidator->trimAll();
            $user = $formValidator->getPosts();
            $toCheckInputs = [
                'pseudo'       => 'Le pseudo',
                'mail'         => 'Le mail',
                'password'     => 'Le mot de passe',
                'github_name'  => 'Le pseudo github'
            ];
            $formValidator->checkEmptyInputs($toCheckInputs);
            $formValidator->checkLength($_POST['password'], 'le mot de passe', 4, 255);
            if (!filter_var($user["mail"], FILTER_VALIDATE_EMAIL)) {
                $errors['formatEmail'] = "Le format de l'email est invalide";
            }
            $formValidator->checkIfMailAlreadyExists($user['mail']);
            $errors = $formValidator->getErrors();
            if (empty($errors)) {
                $userManager = new UserManager();
                $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
                $userId = $userManager->create($user);
                $userData = $userManager->selectOneById($userId);
                $_SESSION['register'] = $userData;
                header('Location: /user/profil?id=' . $userId);
            }
        }
        return $this->twig->render(
            'userData/user.html.twig',
            ['user_succes' => $_GET['add'] ?? null,
                'errors' => $errors]
        );
    }

    public function connect(): string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = array_map('trim', $_POST);
            $userManager = new UserManager();
            $userData = $userManager->selectOneByEmail($user['mail']);
            if ($userData) {
                if (password_verify($user['password'], $userData['password'])) {
                    $_SESSION['register'] = $userData;
                    header('Location: /activite/tout-afficher');
                } else {
                    $errors['idIncorrect'] = 'Vos identifiants de connexion sont incorrects';
                }
            } else {
                $errors['idIncorrect'] = 'Vos identifiants de connexion sont incorrects';
            }
        }
        return $this->twig->render('Home/index.html.twig', ['session' => $_SESSION, 'errors' => $errors]);
    }

    public function logout()
    {
        session_destroy();
        header('location: /');
    }


}

