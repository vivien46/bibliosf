<?php

namespace App\Controller;

use App\Entity\Abonnes;
use App\Form\AbonneFormType;
use App\Repository\AbonnesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AbonneController extends AbstractController
{
    #[Route('/abonne', name: 'app_abonne')]
    public function index(AbonnesRepository $repo): Response
    {

        $abonnes = $repo -> findAll();

        return $this->render('abonne/index.html.twig', [
            'abonnes' => $abonnes,
        ]);
    }

    #[Route('/abonne/new', name: 'new_abonne')]
    public function new (EntityManagerInterface $manager, Request $resquest)
    {
        $abonne = new Abonnes;

        $form = $this->createForm(AbonneFormType::class, $abonne, [
            'button_label' => 'Ajouter un abonné'
        ]);

        $form ->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager ->persist($abonne);
            $manager ->flush();

       return $this->redirectToRoute('app_abonne');
        }

        return $this->render('abonne/new.html.twig', [
            'abonneForm' => $form,
            'abonne' => $abonne,
        ]);
    }

    #[Route('/abonne/edit/{id}', name: 'edit_abonne')]
    public function update(AbonnesRepository $repo, EntityManagerInterface $manager, Request $resquest, $id)
    {
        $abonne = $repo->find($id);

        $form = $this->createForm(AbonneFormType::class, $abonne, [
            'button_label' => "Modifier l'abonné"
        ]);

        $form ->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager ->persist($abonne);
            $manager ->flush();

       return $this->redirectToRoute('app_abonne');
        }

        return $this->render('abonne/new.html.twig', [
            'abonneForm' => $form,
            'abonne' => $abonne,
        ]);
    }
    
    #[Route('/abonne/delete/{id}', name: 'delete_abonne')]
    public function delete(Abonnes $abonne, EntityManagerInterface $manager, Request $resquest, $id)
    {

       if ($abonne) {
         $manager ->remove($abonne);
         $manager ->flush();
         $this ->addFlash('success', "Abonné supprimé avec succes"); 
         return $this->redirectToRoute('app_abonne');
       }

       return $this->render('abonne/index.html.twig', [
        //    'abonneForm' => $form,
           'abonne' => $abonne,
       ]);
    }
}