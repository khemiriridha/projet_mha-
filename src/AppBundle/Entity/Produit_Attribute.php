<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Attribute;

/**
 * Produit_Attribute
 *
 * @ORM\Table(name="produit__attribute")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Produit_AttributeRepository")
 */
class Produit_Attribute
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
     * @ORM\Column(name="valeur", type="string", length=255)
     */
    private $valeur;

     /**
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="produitAttribute")
     */
    private $produit;

     /**
     * @ORM\ManyToOne(targetEntity="Attribute", inversedBy="produit_Attribute;")
     */
    private $attribute;
    

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
     * Set valeur
     *
     * @param string $valeur
     *
     * @return Produit_Attribute
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }

    /**
     * Set produit
     *
     * @param \AppBundle\Entity\Produit $produit
     *
     * @return Produit_Attribute
     */
    public function setProduit(\AppBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \AppBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set attribute
     *
     * @param \AppBundle\Entity\Attribute $attribute
     *
     * @return Produit_Attribute
     */
    public function setAttribute(\AppBundle\Entity\Attribute $attribute = null)
    {
        $this->attribute = $attribute;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return \AppBundle\Entity\Attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}
