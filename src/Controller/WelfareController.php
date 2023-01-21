<?php

namespace App\Controller;

use App\Entity\Welfare;
use App\Form\WelfareType;
use App\Repository\WelfareRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelfareController extends AbstractController
{
    #[Route('/welfare', name: 'app_welfare')]
    public function index(Request $request, WelfareRepository $welfareRepository): Response
    {

        $welfare = new Welfare();
        $form = $this->createForm(WelfareType::class, $welfare);
//        $form->setResponseAt(date_create(now));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $welfareRepository->save($welfare, true);

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }
        $this->addFlash('success', "Nous prenons bien en compte votre réponse");

        return $this->render('welfare/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
