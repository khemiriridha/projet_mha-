<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Shop;
use AppBundle\Entity\User;
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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class ShopController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {  //  var_dump($this->getUser());
        // replace this example code with whatever you need

        // get current user id
        // get user's details + role
        $em=$this->getDoctrine()->getManager();
        $RAW_QUERY = 'SELECT p.nom as prod_nom,p.file as prod_file ,p.prix as prod_prix
FROM
    produit p
WHERE 
p.id > 39

';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $prod  = $statement->fetchAll();
        return $this->render('default/index.html.twig', array(
            'prods' =>$prod,
            )
           );
    }
    /**
     * @Route("boutique/home/{id_shopp}", name="homepage1")
     */
    public function index1Action( $id_shopp)
    {  //  var_dump($this->getUser());
        // replace this example code with whatever you need

        // get current user id
        // get user's details + role

        $em=$this->getDoctrine()->getManager();
        $shop=$em->getRepository('AppBundle:Shop')->findById( $id_shopp);


        return $this->render('default/index1.html.twig', array(
            'shops' =>$shop,

        ));
    }
	 /**
     * @Route("/boutique/remove_session", name="remove_session_shop")
     */
	  public function removeSessionShop(Request $request){
	      $id_shop = $this->get('session')->get('id_shop');
		$this->get('session')->remove('shop_produits');
		return $this->redirectToRoute('show_page_shop', array('id' => trim($id_shop) ));  
		  
		  
	 }
	 /**
     * @Route("/boutique/session", name="set_session_shop")
     */
	 public function setSessionShop(Request $request){
		$produits = array();
	    $id =  $request->request->get('id_product');
		$produitname =  $request->request->get('produit_name'); 
		$prx =  $request->request->get('prx'); 
		$description =  $request->request->get('description');
		
		$image =  $request->request->get('src');
		$nb_produit =  $request->request->get('nb_produit');
		$id_shop =  $request->request->get('id_shop');
		$this->get('session')->set('id_shop', $id_shop);
		$shop_produits = $this->get('session')->get('shop_produits');
		if(!isset($shop_produits)){
			$produits[] = array(
                        'id' =>  $id ,
                        'produitname' => $produitname,
                        'prix' =>  $prx,
                        'description' => $description,
                        'image' => $image ,
						'nb_produit' => $nb_produit 
                    );
	         $this->get('session')->set('shop_produits', $produits);
			
		}else {
			$shop_produits[] = array(
                        'id' =>  $id ,
                        'produitname' => $produitname,
                        'prix' =>  $prx,
                        'description' => $description,
                        'image' => $image ,
						'nb_produit' => $nb_produit 
                    );
			$this->get('session')->set('shop_produits', $shop_produits);
		}
		
	    $response = array( 
                 "size" => sizeof($shop_produits),
                 "response" => 1 
			   );	
		return new JsonResponse($response);
		  
		  
		  
	 }
	 
	 /**
     * @Route("/boutique/cart", name="show_cart_shop")
     */
    public function showCartAction(Request $request)
    {
         
        return $this->render('shop_cart.html.twig');
    }
	
     /**
     * @Route("/boutique/popup", name="show_popup_shop")
     */
	 public function showPopupShop(Request $request){
		 
		$src =  $request->request->get('src'); 
		$produitname =  $request->request->get('produitname'); 
		$prx =  $request->request->get('prx'); 
		$description =  $request->request->get('description');
		$id =  $request->request->get('id_product');
		$id_shop =  $request->request->get('id_shop');
		$response = array( 
                 "code" => 200,
                 "response" => $this->render('modal/modal_shop.html.twig',
				               array('src' =>$src,
							         'produitname' =>$produitname,
									 'prx' =>$prx,
									 'description' =>$description,
									 'id' =>$id,
									 'id_shop' =>$id_shop,
							   )
				 )->getContent() 
			   );
			return new JsonResponse($response);
		 //echo json_encode(array('result' => true, 'html' => $html));
		  
	 }
    /**
     * @Route("/boutique/{id}", name="show_page_shop")
     */
    public function showShopPageAction(Request $request, Shop $shop)
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository('AppBundle:Produit')->findByShop($shop);
        $id_shop = $shop->getId();
        $RAW_QUERY = 
		
		      'SELECT c.nom,c.id
              FROM categorie c,
                   produit_categorie pc,
                   produit p,
                   shop s
                WHERE
                   c.id = pc.categorie_id 
				   AND pc.produit_id = p.id 
				   AND p.shop_id = s.id 
				   AND s.id = '.$shop->getId().' 
                   GROUP BY c.id;';
				   
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $cats  = $statement->fetchAll();
		
		 // $shop_produits = $this->get('session')->get('shop_produits');
         // print_r($shop_produits);
		 // die();

        return $this->render('boutique.html.twig', array(
            'produits' =>$produits,
            'cats' =>$cats,
            'id_shop' =>$id_shop,
            'shop_img' =>$shop->getLogo(),

        ));
    }
	 

    /**
     * @Route("/p1/{id_cat}/{id_shop}", name="cat_prod")
     */
    public function showProduitShop($id_cat ,$id_shop)
    {
        $em=$this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT c.nom as cat_nom, p.nom as prod_nom,p.file as prod_tof, p.prix as prod_prix ,p.shop_id as id_shop
FROM
   produit p,
   categorie c,
    produit_categorie pc
   
   
WHERE
      c.id = pc.categorie_id AND pc.produit_id = p.id AND pc.categorie_id= '.$id_cat.' and p.shop_id = '.$id_shop.'
';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $cats  = $statement->fetchAll();


        return $this->render('default/p1.html.twig', array(
            'cats' =>$cats,

        ));
    }
    /**
     * @Route("boutique/contact/{id_shopp}", name="show_contact_shop")
     */
    public function showShopContactAction($id_shopp)
    {

        $em=$this->getDoctrine()->getManager();
        $shop=$em->getRepository('AppBundle:Shop')->findById( $id_shopp);



        return $this->render('default/contact.html.twig', array(
            'shops' =>$shop,

        ));
    }







    /**
     * @Route("contacter_nous", name="show_contact_index")
     */
    public function showContactIndexPageAction()
    {
        return $this->render('default/contactIndex.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("produits_index", name="show_Produits_index")
     */
    public function showProduitIndexPageAction()
    {

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('AppBundle:Produit')->findAll();

        $RAW_QUERY = 'SELECT c.nom as cat_nom , c.id as cat_id
FROM
    categorie c
WHERE c.id > 0
';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $cattt = $statement->fetchAll();
        return $this->render('Default/produit-index.html.twig', array(
            'produit' => $produit,
            'cattt' => $cattt
        ));
    }

        /**
    }
     * @Route("/p1index/{id_cat}", name="cat_prodindex")
     */
    public function showProduitP1indexShop($id_cat)
    {
        $em=$this->getDoctrine()->getManager();

        $RAW_QUERY = 'SELECT c.nom as cat_nom, c.id as cat_id, p.nom as prod_nom,p.file as prod_tof, p.prix as prod_prix
                      FROM
                       produit p,
                       categorie c,
                       produit_categorie pc
                       WHERE
                       c.id = pc.categorie_id AND pc.produit_id = p.id AND pc.categorie_id= '.$id_cat.' 
                     ';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
        $cattt  = $statement->fetchAll();


        return $this->render('default/p1index.html.twig', array(
            'cattt' =>$cattt

        ));
    }



    /**
     * @Route("boutique/contact", name="show_page_contact_shop")
     */
    public function showContactShopPageAction()
    {
        return $this->render('default/contact.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("about", name="show_page_about_shop")
     */
    public function showAboutPageAction()
    {
        return $this->render('default/aboutindex.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("boutique/about/{id_shopp}", name="about")
     */
    public function aboutAction( $id_shopp)
    {

        $em=$this->getDoctrine()->getManager();
        $shop=$em->getRepository('AppBundle:Shop')->findById( $id_shopp);


        return $this->render('default/about.html.twig', array(
            'shops' =>$shop,

        ));
    }
	
	public function cartAction(Request $request )
    {
	   return $this->render('cart.html.twig');
    }

}
