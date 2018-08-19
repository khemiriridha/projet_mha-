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


class VendeurController extends Controller
{


    }
