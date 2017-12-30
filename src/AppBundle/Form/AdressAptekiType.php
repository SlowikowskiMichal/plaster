<?php

namespace AppBundle\Form;

use AppBundle\Entity\AdressApteki;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressAptekiType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('latitude',TextType::class)
            ->add('longitude', TextType::class)
            ->add('miasto',TextType::class)
            ->add('ulica', TextType::class)
            ->add('nrBud', TextType::class)
            ->add('apteka', EntityType::class, array(
                'class' => 'AppBundle\Entity\Apteka',
                'choice_label' => 'apteka',
                'multiple' => false,
                'expanded' => false
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
            'data_class' => AdressApteki::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_adressapteki';
    }


}
