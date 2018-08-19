<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Slider
 *
 * @ORM\Table(name="slider")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SliderRepository")
 */
class Slider
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
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={  "image/jpeg","image/png"  })
     */
    private $imaslider;
    /**
     * @ORM\ManyToOne(targetEntity="Shop", inversedBy="Slider")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     */
    private $shop;

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
     * Set imaslider
     *
     * @param string $imaslider
     *
     * @return Slider
     */
    public function setImaslider($imaslider)
    {
        $this->imaslider = $imaslider;

        return $this;
    }

    /**
     * Get imaslider
     *
     * @return string
     */
    public function getImaslider()
    {
        return $this->imaslider;
    }

    /**
     * Set shop
     *
     * @param \AppBundle\Entity\Shop $shop
     *
     * @return Slider
     */
    public function setShop(\AppBundle\Entity\Shop $shop = null)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get shop
     *
     * @return \AppBundle\Entity\Shop
     */
    public function getShop()
    {
        return $this->shop;
    }
}
