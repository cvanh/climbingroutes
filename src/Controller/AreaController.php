<?php

namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaFormType;
use App\Repository\AreaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AreaController extends AbstractController
{
    #[Route('/area', name: 'app_area')]
    public function index(AreaRepository $areaRepository): Response
    {
        $areas = $areaRepository->findAll();

        return $this->render('area/index.html.twig', ["areas" => $areas]);
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

        $form->get("author")->setData($this->getUser());

        return $this->render('area/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/area/{id}', name: 'app_viewArea')]
    public function viewAreaPage(int $id, AreaRepository $areaRepository): Response
    {
        $area = $areaRepository->find($id);
        return $this->render('area/view.html.twig', [
            'area' => $area
        ]);
    }
}