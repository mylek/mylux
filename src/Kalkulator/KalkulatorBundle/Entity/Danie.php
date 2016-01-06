<?php

namespace Kalkulator\KalkulatorBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="danie")
 */
class Danie {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="smallint", length=4)
     * 
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 9999
     * )
     */
    private $gram;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "Produkt"
     * )
     * @ORM\JoinColumn(
     *      name = "produkt_id",
     *      referencedColumnName = "id",
     *      onDelete = "SET NULL"
     * )
     */
    
    private $produkty;

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
     * Set gram
     *
     * @param integer $gram
     * @return Danie
     */
    public function setGram($gram)
    {
        $this->gram = $gram;

        return $this;
    }

    /**
     * Get gram
     *
     * @return integer 
     */
    public function getGram()
    {
        return $this->gram;
    }

    /**
     * Set produkty
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Produkt $produkty
     * @return Danie
     */
    public function setProdukty(\Kalkulator\KalkulatorBundle\Entity\Produkt $produkty = null)
    {
        $this->produkty = $produkty;

        return $this;
    }

    /**
     * Get produkty
     *
     * @return \Kalkulator\KalkulatorBundle\Entity\Produkt 
     */
    public function getProdukty()
    {
        return $this->produkty;
    }
}
