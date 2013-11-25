<?php
namespace Perga\ProductBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_categories")
 * @ORM\Entity
 */
class ProductCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;
    /**
     * @var Product;
     *
     * @ORM\OneToMany(targetEntity="Product", mappedBy = "category", cascade={"all"})
     */
    private $products;


    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ProductCategories
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function setProducts($products)
    {
        if (count($products) > 0) {
            foreach ($products as $product) {
                $this->addProduct($product);
            }
        }

        return $this;
    }

    public function addProduct(\Perga\ProductBundle\Entity\Product $product)
    {
        $product->setCategory($this);
        $this->products->add($product);
        return $this;
    }

    /**
     * Remove products
     *
     * @param \Perga\ProductBundle\Entity\Product $products
     */
    public function removeProduct(\Perga\ProductBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
        $product->setCategory(null);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }
}