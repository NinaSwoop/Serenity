<?php

namespace App\Form;

use App\Entity\Checklist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ChecklistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Carte Vitale'
                ],
                'required' => true,
                'label' => 'À ne pas oublier avant l\'hospitalisation:',
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Obligatoire'
                ],
                'required' => true,
                'label' => 'Précisions :',
                'empty_data' => "Facultatif"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Checklist::class,
        ]);
    }
}
