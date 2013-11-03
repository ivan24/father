<?php

namespace Perga\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductImages
 *
 * @ORM\Table(name="currency")
 * @ORM\Entity
 */
class Currency
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
     * @ORM\Column(name="code", type="integer", length=4, nullable=false)
     */
    private $code;
    /**
     * @var string
     *
     * @ORM\Column(name="abbr", type="string", length=4, nullable=false)
     */
    private $abbr;

    /**
     * @var string
     *
     * @ORM\Column(name="rate", type="float", length=4, nullable=false)
     */
    private $rate;

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
     * Set abbr
     *
     * @param string $abbr
     * @return Currency
     */
    public function setAbbr($abbr)
    {
        $this->abbr = $abbr;
    
        return $this;
    }

    /**
     * Get abbr
     *
     * @return string 
     */
    public function getAbbr()
    {
        return $this->abbr;
    }

    /**
     * Set rate
     *
     * @param float $rate
     * @return Currency
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return Currency
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    function __toString()
    {
        return $this->getAbbr();
    }

}