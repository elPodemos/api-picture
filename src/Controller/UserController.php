<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/user', name: 'app_user')]
class UserController extends AbstractController
{

    public function __construct(
        private UserRepository $userRepository,
    ) {
    }

    #[Route('/', name: 'app_user_index')]
    public function index(): Response
    {
        $users = $this->userRepository->findAll();
        return $this->json($users, 200, [], ['groups' => 'allUser']);
    }

    #[Route('/show/{id}', name: 'app_user_show')]
    public function show($id): Response
    {
        $user = $this->userRepository->find($id);

        if ($user === null) {
            return $this->redirectToRoute('app_picture');
        }

        return $this->json($user, 200, [], ['groups' => 'allUser']);
    }
}
