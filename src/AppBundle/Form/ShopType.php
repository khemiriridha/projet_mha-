<?php 
// src/AppBundle/Form/ShopType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Shop;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ShopType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class)
            ->add('description',TextType::class)
            ->add('Activite',TextType::class)
            ->add('Telephone',TextType::class)
            ->add('Adresse',TextType::class)
            ->add('logo',FileType::class, array('data_class' => null,))
            ->add('statut',TextType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => Shop::class,
    ));
}
}