<?php

namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AreaController extends AbstractController
{
    #[Route('/area', name: 'app_area')]
    public function index(): Response
    {
        return $this->render('area/index.html.twig');
    }

    #[Route('/area/create', name: 'app_createArea')]
    public function createAreaPage(EntityManagerInterface $entityManager, Request $request): Response
    {
        // create new area instance
        $area = new Area();
        $form = $this->createForm(AreaFormType::class, $area);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // save fields to db
            $entityManager->persist($form->getData());

            // persist data to db 
            $entityManager->flush();

            // redirect to the area overview
            return $this->redirectToRoute('app_home_page');
        }

        return $this->render('area/create.html.twig', [
            'form' => $form,
        ]);
    }
}