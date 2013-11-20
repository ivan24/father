<?php
namespace Perga\ProductBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * ProductPrice
 *
 * @ORM\Table(name="product_price")
 * @ORM\Entity
 */
class ProductPrice 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \Perga\ProductBundle\Entity\Product
     *
     * @ORM\ManyToOne(targetEntity="Perga\ProductBundle\Entity\Product", inversedBy="prices")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */

    private $value;
    /**
     * @var string
     *
     * @ORM\Column(name="price", type="float", length=255, nullable=false)
     */
    private $price;

    /**
     * @var Currency
     *
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     * })
     */
    private $currency;

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
     * Set value
     *
     * @param string $value
     * @return ProductPrice
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return ProductPrice
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set product
     *
     * @param \Perga\ProductBundle\Entity\Product $product
     * @return ProductPrice
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

    /**
     * Set currency
     *
     * @param \Perga\ProductBundle\Entity\Currency $currency
     * @return ProductPrice
     */
    public function setCurrency(\Perga\ProductBundle\Entity\Currency $currency = null)
    {
        $this->currency = $currency;
    
        return $this;
    }

    /**
     * Get currency
     *
     * @return \Perga\ProductBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    function __toString()
    {
        return sprintf("%s %s",$this->getValue(), $this->getPrice());
    }
}