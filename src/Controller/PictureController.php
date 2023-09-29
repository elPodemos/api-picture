<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('api/picture', name: 'app_picture')]
class PictureController extends AbstractController
{

    public function __construct(
        private PictureRepository $pictureRepository,
    ) {
    }

    #[Route('/', name: 'app_picture_index')]
    public function index(): Response
    {
        $pictures = $this->pictureRepository->findAll();
        // dd($this->getUser());
        return $this->json($pictures, 200, [], ['groups' => 'allPicture']);
    }

    #[Route('/show/{id}', name: 'app_picture_show')]
    public function show($id): Response
    {
        $picture = $this->pictureRepository->find($id);

        if ($picture === null) {
            return $this->redirectToRoute('app_picture');
        }

        return $this->json($picture, 200, [], ['groups' => 'allPicture']);
    }
}
