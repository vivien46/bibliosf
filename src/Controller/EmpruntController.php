<?php

namespace App\Controller;

use App\Entity\Emprunts;
use App\Form\EmpruntFormType;
use App\Repository\EmpruntsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt', name: 'app_emprunt')]
    public function index(EmpruntsRepository $repo): Response
    {

        $emprunts = $repo -> findAll();

        return $this->render('emprunt/index.html.twig', [
            'emprunts' => $emprunts,
        ]);
    }

    #[Route('/emprunt/new', name: 'new_emprunt')]
    public function new (EntityManagerInterface $manager, Request $resquest)
    {
        $emprunt = new Emprunts;

        $form = $this->createForm(empruntFormType::class, $emprunt, [
            'button_label' => 'Ajouter un emprunt'
        ]);

        $form ->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager ->persist($emprunt);
            $manager ->flush();

       return $this->redirectToRoute('app_emprunt');
        }

        return $this->render('emprunt/new.html.twig', [
            'empruntForm' => $form,
            'emprunt' => $emprunt,
        ]);
    }

    #[Route('/emprunt/edit/{id}', name: 'edit_emprunt')]
    public function update(EmpruntsRepository $repo, EntityManagerInterface $manager, Request $resquest, $id)
    {
        $emprunt = $repo->find($id);

        $form = $this->createForm(EmpruntFormType::class, $emprunt, [
            'button_label' => "Modifier l'emprunt"
        ]);

        $form ->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager ->persist($emprunt);
            $manager ->flush();

       return $this->redirectToRoute('app_emprunt');
        }

        return $this->render('emprunt/new.html.twig', [
            'empruntForm' => $form,
            'emprunt' => $emprunt,
        ]);
    }
    
    #[Route('/emprunt/delete/{id}', name: 'delete_emprunt')]
    public function delete(Emprunts $emprunt, EntityManagerInterface $manager, Request $resquest, $id)
    {

       if ($emprunt) {
         $manager ->remove($emprunt);
         $manager ->flush();
         $this ->addFlash('success', "emprunt supprimé avec succes"); 
         return $this->redirectToRoute('app_emprunt');
       }

       return $this->render('emprunt/index.html.twig', [
        //    'empruntForm' => $form,
           'emprunt' => $emprunt,
       ]);
    }
}
