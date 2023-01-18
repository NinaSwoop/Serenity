<?php

namespace App\Controller;

use App\Entity\Video;
use App\Repository\CategoryRepository;
use App\Repository\UserVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserVideoController extends AbstractController
{
    #[Route('/user/video', name: 'app_user_video')]
    public function index(): Response
    {
        return $this->render('user_video/index.html.twig', [
            'controller_name' => 'UserVideoController',
        ]);
    }

    #[Route('/{id}/check/video', name: 'app_video_check')]
    public function checkDocument(
        Video $video,
        UserVideoRepository $userVideoRepository,
        CategoryRepository $categoryRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $userVideo = $userVideoRepository->findOneby(
            [
                'video' => $video->getId(),
                'user' => $user->getId()
            ]
        );

        if ($userVideo->isIsChecked()) {
            $userVideo->setIsChecked(false);
        } else {
            $userVideo->setIsChecked(true);
        }

        $userVideoRepository->save($userVideo, true);

        $category = $categoryRepository->findOneBy(['title' => 'Comprendre mon opération']);

        return $this->redirectToRoute('app_category_show', ['id' => $category->getId()], Response::HTTP_SEE_OTHER);
    }
}
