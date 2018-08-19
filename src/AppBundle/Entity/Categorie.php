<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\Produit;


/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\ManyToMany(targetEntity="Produit", cascade={"persist"}, mappedBy="categorie")
     * @ORM\JoinTable(name="produit_categorie")
     */
    private $Produit;

    /**
     * @ORM\ManyToOne(targetEntity="Promotion", inversedBy="categorie")
     */
    private $Promotion;


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
     * @return Categorie
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
     * @return Categorie
     */
    public function addProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->Produit[] = $produit;

        return $this;
    }

    /**
     * Remove produit
     *
     * @param \AppBundle\Entity\Produit $produit
     */
    public function removeProduit(\AppBundle\Entity\Produit $produit)
    {
        $this->Produit->removeElement($produit);
    }

    /**
     * Get produit
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduit()
    {
        return $this->Produit;
    }

    /**
     * Set promotion
     *
     * @param \AppBundle\Entity\Promotion $promotion
     *
     * @return Categorie
     */
    public function setPromotion(\AppBundle\Entity\Promotion $promotion = null)
    {
        $this->Promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return \AppBundle\Entity\Promotion
     */
    public function getPromotion()
    {
        return $this->Promotion;
    }
}
