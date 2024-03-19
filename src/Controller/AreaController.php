<?php

namespace App\Controller;

use App\Entity\Area;
use App\Form\AreaFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
    public function createAreaPage(EntityManagerInterface $entityManager): Response
    {
        // creates a task object and initializes some data for this example
        $area = new Area();
        $form = $this->createForm(AreaFormType::class, $area);

        echo "asd";
        // var_dump($form);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $input = $form->getData();
            $area->setAuthor($this->getUser());
            var_dump($input);
            // $area->rock_type($)

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_area');
        }

        $form = $this->createFormBuilder($area)
            ->add('name', TextType::class)
            ->add('rock_type', TextType::class)
            ->add('location', TextType::class)
            ->add('description', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create area'])
            ->getForm();

        return $this->render('area/create.html.twig', [
            'form' => $form,
        ]);
    }

}
