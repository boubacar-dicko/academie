<?php

namespace App\Form;

use App\Entity\Etablissement;
use App\Entity\Examen;
use App\Entity\Inscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('nomEtablissement', EntityType::class, [
                // looks for choices from this entity
                'class' => Etablissement::class,
                'choice_label' => 'nomEtablissement',
                 ])
            ->add('nomExamen', EntityType::class, [
                // looks for choices from this entity
                'class' => Examen::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nomExamen',
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('dateNaiss')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
