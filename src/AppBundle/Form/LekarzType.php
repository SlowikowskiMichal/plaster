<?php

namespace AppBundle\Form;

use AppBundle\Entity\Lekarz;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LekarzType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imie', TextType::class)
            ->add('nazwisko', TextType::class)
            ->add('telephone', TextType::class)
            ->add('user', EntityType::class, array(
                'class' => 'AppBundle\Entity\User',
                'query_builder' => function (EntityRepository $er) {
                    return $er
                        ->createQueryBuilder('q')
                        ->where('q.role = 2');
                },
                'choice_label' => 'username',
                'multiple' => false,
                'expanded' => false
            ))
            ->add('specjalizacja', EntityType::class, array(
                'class' => 'AppBundle\Entity\Specjalizacja',
                'choice_label' => 'name',
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
            'data_class' => Lekarz::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_lekarz';
    }


}
