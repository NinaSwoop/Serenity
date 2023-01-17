<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Document;
use App\Repository\CategoryRepository;
use App\Repository\UserDocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserDocumentController extends AbstractController
{
    #[Route('/user/document', name: 'app_user_document')]
    public function index(): Response
    {
        return $this->render('user_document/index.html.twig', [
            'controller_name' => 'UserDocumentController',
        ]);
    }

    #[Route('/{id}/check', name: 'app_document_check')]
    public function checkDocument(
        Document $document,
        UserDocumentRepository $userDocRepository,
        CategoryRepository $categoryRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $userDocument = $userDocRepository->findOneby(
            [
                'document' => $document->getId(),
                'user' => $user->getId()
            ]
        );

        if ($userDocument->isIsChecked()) {
            $userDocument->setIsChecked(false);
        } else {
            $userDocument->setIsChecked(true);
        }

        // Ajouter implémentation de la date ou retrait si on uncheck
        $userDocRepository->save($userDocument, true);

        $category = $categoryRepository->findOneBy(['title' => 'Finir les démarches administratives']);

        return $this->redirectToRoute('app_category_show', ['id' => $category->getId()], Response::HTTP_SEE_OTHER);
    }
}
