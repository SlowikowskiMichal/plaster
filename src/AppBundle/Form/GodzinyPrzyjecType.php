<?php

namespace AppBundle\Form;

use AppBundle\Entity\GodzinyPrzyjec;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GodzinyPrzyjecType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', TimeType::class)
            ->add('end', TimeType::class)
            ->add('lekarz', EntityType::class, array(
                'class' => 'AppBundle\Entity\Lekarz',
                'choice_label' => 'lekarz',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('tydzien', EntityType::class, array(
                'class' => 'AppBundle\Entity\Tydzien',
                'choice_label' => 'user',
                'multiple' => false,
                'expanded' => true
            ))
            ->add('Zarejestruj',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GodzinyPrzyjec::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_godzinyprzyjec';
    }


}
