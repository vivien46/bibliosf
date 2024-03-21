<?php

namespace App\Form;

use App\Entity\Abonnes;
use App\Entity\Emprunts;
use App\Entity\Livres;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EmpruntFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateEmprunt', DateType::class, [
                // 'widget' => 'single_text', // pour avoir un sélecteur de date au lieu de trois menus déroulants
                'data' => new \DateTime(), // définit la date d'aujourd'hui comme valeur par défaut
            ])
            ->add('dateRetour', DateType::class, [
                // 'widget' => 'single_text', // pour avoir un sélecteur de date au lieu de trois menus déroulants
                // 'data' => new \DateTime("now"), // définit la date d'aujourd'hui comme valeur par défaut
            ])
            ->add('livres', EntityType::class, [
                'class' => Livres::class,
                'choice_label' => 'title',
            ])
            ->add('abonnes', EntityType::class, [
                'class' => Abonnes::class,
                'choice_label' => 'prenom',
            ])
            ->add("Enregistrer", SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ],
                'label' => $options['button_label']

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunts::class,
            'button_label' => 'Enregistrer'
        ]);
    }
}
