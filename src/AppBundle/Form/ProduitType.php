<?php 
// src/AppBundle/Form/ProduitType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Attribute;
use AppBundle\Form\ProduitAttribute;
use AppBundle\Form\ProduitAttributeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom',TextType::class)
        ->add('description',TextType::class)
        ->add('prix',NumberType::class)
        ->add('file',FileType::class, array('data_class' => null, 'attr' => array(
            'accept' => 'image/*',
            'multiple' => 'multiple'
        )))
       // ->add('file', FileType::class, array(
           // 'multiple' => true,
           // 'data_class' => null,)
      //  )
        ->add('categorie',EntityType::class, array(
            'class' => Categorie::class,

            'choice_label' => 'nom',
            'attr' => ['data-select' => 'true'],
            'choices_as_values' => true,
            'multiple' => true,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->orderBy('c.nom', 'ASC');
            },
        ))

        ->add('produitAttribute', CollectionType::class, array(
            'entry_type' =>  ProduitAttributeType::class,
            'allow_add' => true,
            'allow_delete'=>true,
            'by_reference'=>false,
            'prototype' => true,
            'prototype_name'=>'produit',
        ))
        ->add('save', SubmitType::class)
        
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults(array(
        'data_class' => Produit::class,
    ));
    }
}