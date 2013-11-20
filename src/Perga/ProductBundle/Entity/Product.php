<?php

namespace Perga\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Perga\ProductBundle\Entity\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;


    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name", "id"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */

    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text", nullable=true)
     */

    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keyword", type="string", nullable=true)
     */
    private $metaKeyword;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", nullable=true)
     */
    private $metaDescription;

    /**
     * @var ProductPrice
     *
     * @ORM\OneToMany(targetEntity="ProductPrice", mappedBy="product",cascade={"all"},orphanRemoval=true)
     */
    private $prices;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_order", type="smallint", nullable=false)
     */
    private $productOrder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var \ProductCategories
     *
     * @ORM\ManyToOne(targetEntity="ProductCategories", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->prices = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Product
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
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

    /**
     * Set metaKeyword
     *
     * @param string $metaKeyword
     * @return Product
     */
    public function setMetaKeyword($metaKeyword)
    {
        $this->metaKeyword = $metaKeyword;

        return $this;
    }

    /**
     * Get metaKeyword
     *
     * @return string
     */
    public function getMetaKeyword()
    {
        return $this->metaKeyword;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Product
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set productOrder
     *
     * @param integer $productOrder
     * @return Product
     */
    public function setProductOrder($productOrder)
    {
        $this->productOrder = $productOrder;

        return $this;
    }

    /**
     * Get productOrder
     *
     * @return integer
     */
    public function getProductOrder()
    {
        return $this->productOrder;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Product
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function setPrices($prices)
    {
        if (count($prices) > 0) {
            foreach ($prices as $price) {
                $this->addPrice($price);
            }
        }

        return $this;
    }
    /**
     * Add price
     *
     * @param \Perga\ProductBundle\Entity\ProductPrice $price
     * @return Product
     */
    public function addPrice(\Perga\ProductBundle\Entity\ProductPrice $price)
    {
        $price->setProduct($this);

        $this->prices->add($price);

        return $this;
    }

    /**
     * Remove price
     *
     * @param \Perga\ProductBundle\Entity\ProductPrice $price
     */
    public function removePrice(\Perga\ProductBundle\Entity\ProductPrice $price)
    {
        $this->prices->removeElement($price);
    }

    /**
     * Get prices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * Set category
     *
     * @param \Perga\ProductBundle\Entity\ProductCategories $category
     * @return Product
     */
    public function setCategory(\Perga\ProductBundle\Entity\ProductCategories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Perga\ProductBundle\Entity\ProductCategories
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    function __toString()
    {
        return $this->getName();
    }

}