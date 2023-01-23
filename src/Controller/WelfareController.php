<?php

namespace App\Controller;

use App\Entity\Welfare;
use App\Form\WelfareType;
use App\Repository\WelfareRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class WelfareController extends AbstractController
{
    #[Route('/welfare', name: 'app_welfare')]
    public function index(Request $request, WelfareRepository $welfareRepository): Response
    {

        $welfare = new Welfare();
        $welfareform = $this->createForm(WelfareType::class, $welfare);

        $welfareform->handleRequest($request);

        if ($welfareform->isSubmitted() && $welfareform->isValid()) {
            $welfareRepository->save($welfare, true);

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        $this->addFlash('success', "Nous prenons bien en compte votre réponse");

        return $this->render('welfare/index.html.twig', [
            'form' => $welfareform->createView(),

        ]);
    }
}
