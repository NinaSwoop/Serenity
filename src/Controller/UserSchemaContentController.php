<?php

namespace App\Controller;

use App\Entity\SchemaContent;
use App\Repository\CategoryRepository;
use App\Repository\UserSchemaContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserSchemaContentController extends AbstractController
{
    #[Route('/user/schema/content', name: 'app_user_schema_content')]
    public function index(): Response
    {
        return $this->render('user_schema_content/index.html.twig', [
            'controller_name' => 'UserSchemaContentController',
        ]);
    }

    #[Route('/{id}/check/schema/content', name: 'app_schema_content_check')]
    public function checkSchemaContent(
        SchemaContent $schemaContent,
        UserSchemaContentRepository $userSchemaRepository,
        CategoryRepository $categoryRepository
    ): Response {
        /** @var \App\Entity\User */
        $user = $this->getUser();
        $userSchemaContent = $userSchemaRepository->findOneby(
            [
                'schemaContent' => $schemaContent->getId(),
                'user' => $user->getId()
            ]
        );
        if ($userSchemaContent->isIsChecked()) {
            $userSchemaContent->setIsChecked(false);
        } else {
            $userSchemaContent->setIsChecked(true);
        }

        $userSchemaRepository->save($userSchemaContent, true);

        $category = $categoryRepository->findOneBy(['title' => 'Comprendre mon opération']);

        return $this->redirectToRoute(
            'app_category_show',
            ['title' => $category->getTitle()],
            Response::HTTP_SEE_OTHER
        );
    }
}
