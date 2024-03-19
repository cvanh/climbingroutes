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
        // creates a task object and initializes some data for this example
        $kd = new Area();
        $form = $this->createForm(AreaFormType::class, $kd);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            // $input = $form->getData();
            // $entityManager->persist($this->getUser());
            $entityManager->persist($form->getData());
            $entityManager->flush();
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_home_page');

        }


        return $this->render('area/create.html.twig', [
            'form' => $form,
        ]);
    }
}