<?php 
// src/AppBundle/Form/ProduitType.php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Attribute;
use AppBundle\Entity\Produit_Attribute;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ProduitAttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('attribute', EntityType::class, array(
            'class' => Attribute::class,
            'choice_label' => 'nom',
            'attr' => ['class'=>'col-md-5','data-select' => 'true'],
            'choices_as_values' => true,
            'multiple' => false,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('a')
                    ->orderBy('a.nom', 'ASC');
            },
        ))
            ->add('valeur',null,array('attr'=>array('class'=>'col-md-5',)))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
    $resolver->setDefaults(array(
        'data_class' => Produit_Attribute::class,
    ));
    }
}