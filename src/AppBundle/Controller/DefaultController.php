<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shop;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Categorie;
use AppBundle\Entity\Attribute;
use AppBundle\Entity\Promotion;
use AppBundle\Entity\Slider;
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
use AppBundle\Form\SliderType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserInterface;


class DefaultController extends Controller
{


    /**
     * @Route("/new_shop", name="newshop")
     */
    public function newAction(Request $request)
    { // creates a Shop and gives it some dummy data for this example
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if ($user == null) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $shop = $em->getRepository('AppBundle:Shop')->findOneByUser($user);
        if ($shop) {
            return $this->redirectToRoute('modifiershop', array('id' => $shop->getId()));
        }
        $shop = new Shop();

        $form = $this->createForm(ShopType::class, $shop);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $shop = $form->getData();
            // $file stores the uploaded PDF file
            /* Symfony\Component\HttpFoundation\File\UploadedFile $logo */
            $logo = $shop->getLogo();

            // Generate a unique name for the file before saving it
            $fileName = $logo->getClientOriginalName();

            // Move the file to the directory where brochures are stored
            $logo->move(
                $this->get('kernel')->getProjectDir() . "/" . $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $shop->setLogo($fileName);

            $shop->setUser($user);
            $em->persist($shop);

            $user->addRole("ROLE_VENDEUR");
            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("vendeur/modifier_shop/{id}", name="modifiershop")
     */

    public function editAction(Request $request, Shop $shop)
    {
        $user = $this->getUser();
        if ($shop->getUser() != $user) {
            return new Response('erreur', 403);
        }
        // creates a Shop and gives it some dummy data for this example
        $form = $this->createForm(ShopType::class, $shop);
        //var_dump($form);
        /*  ->add('nom', TextType::class)

        ->add('description', TextType::class)

        ->add('save', SubmitType::class, array('label' => 'Create Shop'))

        ->getForm();

        */

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $shop = $form->getData();
            // $file stores the uploaded PDF file
            /* Symfony\Component\HttpFoundation\File\UploadedFile $logo */
            $logo = $shop->getLogo();

            // Generate a unique name for the file before saving it
            $fileName = $logo->getClientOriginalName();

            // Move the file to the directory where brochures are stored
            $logo->move(
                $this->get('kernel')->getProjectDir() . "/" . $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $shop->setLogo($fileName);



            $em = $this->getDoctrine()->getManager();

            $em->persist($shop);


            $user = $this->get('security.token_storage')
                ->getToken()
                ->getUser();

            $user->setShop($shop);
            $em->flush();

            return $this->redirectToRoute('homepage');

        }

        return $this->render('default/modifier.html.twig', array(

            'form' => $form->createView(),
        ));

        return new Response ('shop modifié');

    }

    /**
     * @Route("affiche_Shop", name="afficheShop")
     */


    public function afficheShopAction()
    {

        $em = $this->getDoctrine()->getManager();

        $shop = $em->getRepository('AppBundle:Shop')->findAll();

        return $this->render('Default/shopList.html.twig', array(
            'shop' => $shop
        ));
    }

    /**
     * @Route("affiche_ShopAdmin", name="afficheShopAdmin")
     */


    public function afficheShopAdminAction()
    {

        $em = $this->getDoctrine()->getManager();

        $shop = $em->getRepository('AppBundle:Shop')->findAll();

        return $this->render('Default/shopListAdmin.html.twig', array(
            'shop' => $shop
        ));
    }

    /**
     * @Route("/dashbord", name="interfaceAdmin")
     */
    public function interfaceAdminAction(Request $request)
    {
        return $this->render('default/interfaceAdmin.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("user/Profile", name="interfaceUser")
     */
    public function interfaceUserAction(Request $request)
    {

        return $this->render('default/Profile.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("vendeur/dashbord", name="interfacevendeur")
     */
    public function interfacevendeurAction(Request $request)
    {
        return $this->render('default/interfaceVendeur.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
        ]);
    }


    /**
     * @Route("vendeur/new_produit", name="newProduit")
     */
    public function newProduitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $shop = $em->getRepository('AppBundle:Shop')->findOneByUser($user);
        if ($shop == null) {
            return $this->redirectToRoute('newshop');
        }
        // creates a Produit and gives it some dummy data for this example
        $produit = new Produit();


        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $produit = $form->getData();

            $em = $this->getDoctrine()->getManager();

            // $file stores the uploaded PDF file
            /* Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $produit->getFile();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $produit->setFile($fileName);
            $produit->setShop($shop);
            $em->persist($produit);
            $em->flush();
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/newProduit.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    /**
     * @Route("vendeur/new_categorie", name="newcategorie")
     */
    public function newCategorieAction(Request $request)
    {
        // creates a Produit and gives it some dummy data for this example
        $categorie = new Categorie();

        /*$produit->setNom('Nom du produit');*/

        $form = $this->createForm(CategorieType::class, $categorie);
        /*  ->add('nom', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Ajout Produit'))
            ->getForm();
        */
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $categorie = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/newCategorie.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("vendeur/afficher_categorie", name="afficherCategorie")
     */


    public function afficheAction()
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $shop = $user->getShop();
        $produits = $shop->getProduit();
        $categoriesArray = [];

        foreach ($produits as $produit) {
            $categories = $produit->getCategorie();
            foreach ($categories as $category) {
                if (!array_key_exists($category->getId(), $categoriesArray)) {
                    $categoriesArray[$category->getId()] = $category;
                }
            }
        }

$categories= array_values($categoriesArray);
        return $this->render('Default/afficheCategorie.html.twig', array(
            'categories' => $categories
        ));

    }

    /**
     * @Route("admin/afficher_categorieAdmin", name="afficherCatAdmin")
     */
    public function affichecatAdminAction()
    {

        $em = $this->getDoctrine()->getManager();

        $categorie = $em->getRepository('AppBundle:Categorie')->findAll();

        return $this->render('Default/afficheCatAdmin.html.twig', array(
            'categorie' => $categorie
        ));

    }

    /**
     * @Route("vendeur/modifier_produit/{id}", name="modifierproduit")
     */

    public function modifierProduitAction(Request $request, Produit $produit)
    {
        // creates a Shop and gives it some dummy data for this example
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($produit);

            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/modifierProduit.html.twig', array(

            'form' => $form->createView(),
        ));
        return new Response ('produit modifié');
    }

    /**
     * @Route("vendeur/mes_produits", name="mes_produits")
     */
    public function mesProduitAction()
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $shop = $user->getShop();
        $produit = $em->getRepository('AppBundle:Produit')->findByShop($shop);

        return $this->render('Default/afficheproduit.html.twig', array(
            'produit' => $produit
        ));

    }



    /**
     * @Route("admin/afficher_produitAdmin", name="afficheProdAdmin")
     */
    public function afficheProduitAdminAction()
    {

        $em = $this->getDoctrine()->getManager();

        $produit = $em->getRepository('AppBundle:Produit')->findAll();

        return $this->render('Default/afficheProdAdmin.html.twig', array(
            'produit' => $produit
        ));

    }

    /**
     * @Route("vendeur/delete_produit/{id}", name="deleteproduit")
     */
    public function deleteAction(Produit $produit)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("vendeur/modifier_categorie/{id}", name="modifiercategorie")
     */

    public function modifierCategorieAction(Request $request, Categorie $categorie)
    {

        // creates a Shop and gives it some dummy data for this example
        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($categorie);

            $em->flush();

            return $this->redirectToRoute('homepage');

        }

        return $this->render('default/modifierCategorie.html.twig', array(

            'form' => $form->createView(),
        ));

        return new Response ('produit modifié');

    }

    /**
     * @Route("vendeur/delete_categorie/{id}", name="deletecategorie")
     */
    public function deleteCategorieAction(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("vendeur/new_Attribute", name="newAttribute")
     */
    public function newAttributeAction(Request $request)
    {
        // creates a Produit and gives it some dummy data for this example
        $attribute = new Attribute();

        /*$produit->setNom('Nom du produit');*/

        $form = $this->createForm(AttributeType::class, $attribute);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $attribute = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($attribute);
            $em->flush();


            return $this->redirectToRoute('homepage');
        }

        return $this->render('default/newAttribute.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("vendeur/promotion/{categorie_id}", name="promoCategorie")
     */
    public function PromotionCategorieAction(Request $request, $categorie_id)
    {
        $promotion = new Promotion();
        $categorie = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->find($categorie_id);
        $form = $this->createForm(PromoType::class, $promotion);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $promotion = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($promotion);
            $categorie->setPromotion($promotion);
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/Promotion.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("vendeur/new_Slider", name="newSlider")
     */
    public function newSliderAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $shop = $em->getRepository('AppBundle:Shop')->findOneByUser($user);
        if ($shop == null) {
            return $this->redirectToRoute('newshop');
        }
        // creates a Produit and gives it some dummy data for this example
        $slider = new Slider();


        $form = $this->createForm(SliderType::class, $slider);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $slider = $form->getData();

            $em = $this->getDoctrine()->getManager();

            // $file stores the uploaded PDF file
            /* Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $imaslider = $slider->getImaslider();

            // Generate a unique name for the file before saving it
            $fileName1 = $imaslider->getClientOriginalName();


            // Move the file to the directory where brochures are stored
            $imaslider->move(
                $this->getParameter('images_directory'),
                $fileName1
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $slider->setImaslider($fileName1);
            $slider->setShop($shop);
            $em->persist($slider);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/newSlider.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("vendeur/modifier_slider/{id}", name="modifierslider")
     */

    public function modifierSliderAction(Request $request, Slider $slider)
    {
        // creates a Shop and gives it some dummy data for this example
        $form = $this->createForm(SliderType::class, $slider);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($slider);

            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/modifierSlider.html.twig', array(

            'form' => $form->createView(),
        ));
        return new Response ('Slider modifié');
    }

    /**
     * @Route("vendeur/delete_slider/{id}", name="deleteslider")
     */
    public function deleteSliderAction(Slider $slider)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($slider);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("vendeur/mes_sliders", name="mes_sliders")
     */
    public function mesSliderAction()
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $shop = $user->getShop();
        $slider = $em->getRepository('AppBundle:Slider')->findByShop($shop);

        return $this->render('Default/afficheSlider.html.twig', array(
            'slider' => $slider
        ));

    }

    /**
     * @Route("admin/list_sliders_Admin", name="list_slidersAdmin")
     */
    public function listSliderAction()
    {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $shop = $user->getShop();
        $slider = $em->getRepository('AppBundle:Slider')->findAll($shop);

        return $this->render('Default/afficheSliderAdmin.html.twig', array(
            'slider' => $slider
        ));

    }

    /**
     * @Route("Activer_Shop/{id}", name="activerShop")
     */
    public function ActiverAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $shop = $em->getRepository(Shop::class )->find($id);
        $shop->setStatut(1);
        $em->persist($shop);

        $em->flush();



        return $this->redirectToRoute('afficheShopAdmin');
    }

    /**
     * @Route("Desactiver_Shop/{id}", name="desactiverShop")
     */
    public function DesactiverAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $shop = $em->getRepository(Shop::class )->find($id);
        $shop->setStatut(0);
        $em->persist($shop);

        $em->flush();



        return $this->redirectToRoute('afficheShopAdmin');
    }

}
