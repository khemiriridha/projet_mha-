<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shop;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Attribute;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\Produit_Attribute;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\ProduitAttributeType;
use AppBundle\Form\ShopType;
use AppBundle\Form\ProduitType;
use AppBundle\Form\CategorieType;
use AppBundle\Form\AttributeType;
use AppBundle\Form\PromoType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;


class AdminController extends Controller
{

    /**
     * @Route("interface_admin", name="interfaceAdmin")
     */
    public function interfaceadminAction(Request $request)
    {
        return $this->render('default/interfaceAdmin.html.twig',[
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


}
