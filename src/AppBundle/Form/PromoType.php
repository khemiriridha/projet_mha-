<?php
/**
 * Created by PhpStorm.
 * User: Maha
 * Date: 10/05/2018
 * Time: 14:49
 */

// src/AppBundle/Form/PromoType.php
namespace AppBundle\Form;

use AppBundle\Entity\Promotion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut',DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required'=>'true',))
            ->add('dateFin',DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required'=>'true',))
            ->add('nouveauPrix', TextType::class)
            ->add('pourcentage', PercentType::class)
            ->add('save',SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Promotion::class,
        ));
    }
}