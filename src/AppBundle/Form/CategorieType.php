<?php 
// src/AppBundle/Form/ProduitType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Produit;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults(array(
        'data_class' => Categorie::class,
    ));
    }
}