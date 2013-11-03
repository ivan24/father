<?php

namespace Perga\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductImages
 *
 * @ORM\Table(name="product_images")
 * @ORM\Entity
 */
class ProductImages
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="src", type="string",nullable=false)
     */
    private $src;

    /**
     * @var \Perga\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="\Perga\ProductBundle\Entity\Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set src
     *
     * @param string $src
     * @return ProductImages
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set product
     *
     * @param \Perga\ProductBundle\Entity\Product $product
     * @return ProductImages
     */
    public function setProduct(\Perga\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Perga\ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}