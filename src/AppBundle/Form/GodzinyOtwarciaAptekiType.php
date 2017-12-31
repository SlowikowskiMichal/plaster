<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GodzinyOtwarciaAptekiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start', TimeType::class)
            ->add('end', TimeType::class)
            ->add('apteka')
            ->add('apteka', EntityType::class, array(
                'class' => 'AppBundle\Entity\Apteka',
                'choice_label' => 'apteka',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('tydzien', EntityType::class, array(
                'class' => 'AppBundle\Entity\Tydzien',
                'choice_label' => 'dzien',
                'multiple' => false,
                'expanded' => true
            ))
            ->add('Zarejestruj',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\GodzinyOtwarciaApteki'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_godzinyotwarciaapteki';
    }


}
