<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Produit;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Shop
 *
 * @ORM\Table(name="shop")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShopRepository")
 */
class Shop
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Activite", type="string", length=255)
     */
    private $Activite;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=255)
     */
    private $Telephone;
     /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=255)
     */
    private $Adresse;

    /**
     * @var boolean
     *
     * @ORM\Column(name="statut", type="boolean" , nullable=true, options={"default":false})
     */
    private $statut;

    /**
     * @return bool
     */
    public function isStatut()
    {
        return $this->statut;
    }

    /**
     * @param bool $statut
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

     /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={  "image/jpeg","image/png"  })
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity="Produit", mappedBy="shop", cascade={"persist", "remove"})
     * 
     */
    private $produit;
    /**
     * @ORM\OneToMany(targetEntity="Slider", mappedBy="shop", cascade={"persist", "remove"})
     *
     */
    private $slider;
    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="shop")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */

    private $user;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Shop
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Shop
     */
    public function setDescription($description)
    {
        
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**Activite
     *
     * @param string $Activite
     *
     * @return Shop
     */
    public function setActivite($Activite)
    {
        $this->Activite = $Activite;

        return $this;
    }

    /**
     * Get Activite
     *
     * @return string
     */
    public function getActivite()
    {
        return $this->Activite;
    }

    /**Telephone
     *
     * @param string $Telephone
     *
     * @return Shop
     */
    public function setTelephone($Telephone)
    {
        $this->Telephone = $Telephone;

        return $this;
    }

    /**
     * Get Telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->Telephone;
    }

    /**Adresse
     *
     * @param string $Adresse
     *
     * @return Shop
     */
    public function setAdresse($Adresse)
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    /**
     * Get Adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->Adresse;
    }

    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->produit = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Shop
     */
    public function addProduit(\AppBundle\Entity\Produit $produit)
    {
       /* $produit->setShop($this);*/

        $this->produit[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \AppBundle\Entity\Produit $produit
     */
    public function removeProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->produit->removeElement($produit);
    }

    /**
     * Get produit
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Shop
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Shop
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }



    /**
     * Add slider
     *
     * @param \AppBundle\Entity\Slider $slider
     *
     * @return Shop
     */
    public function addSlider(\AppBundle\Entity\Slider $slider)
    {
        $this->slider[] = $slider;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param \AppBundle\Entity\Slider $slider
     */
    public function removeSlider(\AppBundle\Entity\Slider $slider)
    {
        $this->slider->removeElement($slider);
    }

    /**
     * Get slider
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSlider()
    {
        return $this->slider;
    }
}
