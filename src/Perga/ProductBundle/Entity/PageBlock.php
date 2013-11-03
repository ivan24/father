<?php
namespace Perga\ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="page_block")
 * @ORM\Entity
 */
class PageBlock 
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
     * @ORM\Column(name="aliace", type="string", length=255, nullable=false)
     */
    private $aliace;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=false)
     */
    private $content;

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
     * Set aliace
     *
     * @param string $aliace
     * @return PageBlock
     */
    public function setAliace($aliace)
    {
        $this->aliace = $aliace;
    
        return $this;
    }

    /**
     * Get aliace
     *
     * @return string 
     */
    public function getAliace()
    {
        return $this->aliace;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return PageBlock
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}