<?php

namespace App\Service;

use App\Repository\CategoryRepository;
use App\Repository\UserChecklistRepository;
use App\Repository\UserDocumentRepository;
use App\Repository\UserMedDisciplineRepository;
use App\Repository\UserMedicalCourseRepository;
use App\Repository\UserSchemaContentRepository;
use App\Repository\UserVideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryService extends AbstractController
{
    private UserDocumentRepository $userDocRepo;
    private CategoryRepository $categoryRepository;
    private UserChecklistRepository $userCheckRepo;
    private UserMedDisciplineRepository $userMedDRepo;
    private UserMedicalCourseRepository $userMedCRepo;
    private UserSchemaContentRepository $userSchemaRepo;
    private UserVideoRepository $userVideoRepo;

    public function __construct(
        UserDocumentRepository $userDocRepo,
        CategoryRepository $categoryRepository,
        UserChecklistRepository $userCheckRepo,
        UserMedDisciplineRepository $userMedDRepo,
        UserMedicalCourseRepository $userMedCRepo,
        UserSchemaContentRepository $userSchemaRepo,
        UserVideoRepository $userVideoRepo
    ) {

        $this->userDocRepo = $userDocRepo;
        $this->categoryRepository = $categoryRepository;
        $this->userCheckRepo = $userCheckRepo;
        $this->userDocRepo = $userDocRepo;
        $this->userMedDRepo = $userMedDRepo;
        $this->userMedCRepo =  $userMedCRepo;
        $this->userSchemaRepo = $userSchemaRepo;
        $this->userVideoRepo = $userVideoRepo;
    }

    public function elementChecked(): array
    {
        $elementsChecked = [];
        $elementsChecked['categories'] =
            $this->categoryRepository->findAll();
        $elementsChecked['documentChecked'] =
            $this->userDocRepo->findBy(['user' => $this->getUser(), 'isChecked' => true]);
        $elementsChecked['CheckListChecked'] =
            $this->userCheckRepo->findBy(['user' => $this->getUser(), 'isChecked' => true]);
        $elementsChecked['medDChecked'] =
            $this->userMedDRepo->findBy(['user' => $this->getUser(), 'isChecked' => true]);
        $elementsChecked['medCChecked'] =
            $this->userMedCRepo->findBy(['user' => $this->getUser(), 'isChecked' => true]);
        $elementsChecked['schemaChecked'] =
            $this->userSchemaRepo->findBy(['user' => $this->getUser(), 'isChecked' => true]);
        $elementsChecked['videoChecked'] =
            $this->userVideoRepo->findBy(['user' => $this->getUser(), 'isChecked' => true]);

        return $elementsChecked;
    }
}
