<?php 
// src/AppBundle/Form/ProduitType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Slider;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class SliderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imaslider',FileType::class, array('data_class' => null, 'attr' => array(
                'accept' => 'image/*',
                'multiple' => 'multiple'
            )))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults(array(
        'data_class' => Slider::class,
    ));
    }
}