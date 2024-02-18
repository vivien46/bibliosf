<?php

namespace App\Form;

use App\Entity\Abonnes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonneFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom')
            ->add("Enregistrer",SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ],
                'label' => $options['button_label']

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnes::class,
            'button_label' => 'Enregistrer',
        ]);
    }
}
