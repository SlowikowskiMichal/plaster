<?php

namespace AppBundle\Form;

use AppBundle\Entity\StanMagazynu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StanMagazynuType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ilosc',TextType::class)
            ->add('cena',TextType::class)
            ->add('apteka', EntityType::class, array(
                'class' => 'AppBundle\Entity\Apteka',
                'choice_label' => 'apteka',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('lek', EntityType::class, array(
                'class' => 'AppBundle\Entity\Lek',
                'choice_label' => 'lek',
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
            'data_class' => StanMagazynu::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_stanmagazynu';
    }


}
