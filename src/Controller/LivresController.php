<?php

namespace App\Controller;

use App\Repository\LivresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Livres;
use App\Form\LivreFormType;

class LivresController extends AbstractController
{
    #[Route('/livre', name: 'app_livres')]
    public function index(LivresRepository $repo): Response
    {

        $livres = $repo -> findAll();

        return $this->render('livres/index.html.twig', [
            'livres' => $livres,
        ]);
    }

    #[Route('/livre/new', name: 'new_livre')]
    public function new (EntityManagerInterface $manager, Request $resquest)
    {
        $livre = new Livres;

        $form = $this->createForm(LivreFormType::class, $livre, [
            'button_label' => 'Ajouter un livre'
        ]);

        $form ->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager ->persist($livre);
            $manager ->flush();

       return $this->redirectToRoute('app_livres');
        }

        return $this->render('livres/new.html.twig', [
            'livreForm' => $form,
            'livre' => $livre,
        ]);
    }

    #[Route('/livre/edit/{id}', name: 'edit_livre')]
    public function update(livresRepository $repo, EntityManagerInterface $manager, Request $resquest, $id)
    {
        $livre = $repo->find($id);

        $form = $this->createForm(LivreFormType::class, $livre, [
            'button_label' => "Modifier le livre"
        ]);

        $form ->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager ->persist($livre);
            $manager ->flush();

       return $this->redirectToRoute('app_livres');
        }

        return $this->render('livres/new.html.twig', [
            'livreForm' => $form,
            'livre' => $livre,
        ]);
    }
    
    #[Route('/livre/delete/{id}', name: 'delete_livre')]
    public function delete(livres $livre, EntityManagerInterface $manager, Request $resquest, $id)
    {

       if ($livre) {
         $manager ->remove($livre);
         $manager ->flush();
         $this ->addFlash('success', "livre supprimé avec succes"); 
         return $this->redirectToRoute('app_livres');
       }

       return $this->render('livres/index.html.twig', [
        //    'livreForm' => $form,
           'livre' => $livre,
       ]);
    }
}
