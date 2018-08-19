<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Produit_Attribute;
/**
 * Attribute
 *
 * @ORM\Table(name="attribute")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttributeRepository")
 */
class Attribute
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
     * @ORM\OneToMany(targetEntity="Produit_Attribute", mappedBy="attribute", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="Produit_Attribute_id", referencedColumnName="id")
     */
    private $produit_Attribute;



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
     * @return Attribute
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
        $this->Produit = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add produitAttribute
     *
     * @param \AppBundle\Entity\Produit_Attribute $produitAttribute
     *
     * @return Attribute
     */
    public function addProduitAttribute(\AppBundle\Entity\Produit_Attribute $produitAttribute)
    {
        $this->produit_Attribute[] = $produitAttribute;

        return $this;
    }

    /**
     * Remove produitAttribute
     *
     * @param \AppBundle\Entity\Produit_Attribute $produitAttribute
     */
    public function removeProduitAttribute(\AppBundle\Entity\Produit_Attribute $produitAttribute)
    {
        $this->produit_Attribute->removeElement($produitAttribute);
    }

    /**
     * Get produitAttribute
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduitAttribute()
    {
        return $this->produit_Attribute;
    }
}
