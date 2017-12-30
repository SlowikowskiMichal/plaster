<?php

namespace AppBundle\Form;

use AppBundle\Entity\Apteka;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AptekaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('telephone', TextType::class)
            ->add('user', EntityType::class, array(
                'class' => 'AppBundle\Entity\User',
                'choice_label' => 'user',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('address',TextType::class)
            ->add('Zarejestruj',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     * @throws \Symfony\Component\OptionsResolver\Exception\AccessException
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apteka::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_apteka';
    }


}
