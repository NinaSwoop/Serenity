<?php

namespace App\Form;

use App\Entity\Welfare;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WelfareType extends AbstractType
{
    // précise les champs souhaité dans le formulaire
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // score = propriété de l'entité, ChoiceType::class = class de formulaire
            ->add('score', ChoiceType::class, array (
                'choices' => array (
                    'mal' => 3,
                    'moyen' => 2,
                    'bien' => 1,
                ),
                    'expanded' => true,
                    'multiple' => false,
                    'label' => false,
                    'attr' => ['class' => 'check-mood']
//            ->add('responseAt')
//            ->add('user')
            ));
    }

    // précise la class de données associée
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Welfare::class,
        ]);
    }
}
