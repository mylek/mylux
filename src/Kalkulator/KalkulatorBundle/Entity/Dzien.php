<?php

namespace Kalkulator\KalkulatorBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dzien")
 */
class Dzien {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /** 
     * @ORM\Column(type="date") 
     */
    private $data;
    
    /**
     * @ORM\Column(type="smallint", length=4)
     * 
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 9999
     * )
     */
    private $godzina;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "Danie"
     * )
     * @ORM\JoinColumn(
     *      name = "danie_id",
     *      referencedColumnName = "id",
     *      onDelete = "SET NULL"
     * )
     */
    private $dania;

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
     * Set data
     *
     * @param \DateTime $data
     * @return Dzien
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set godzina
     *
     * @param integer $godzina
     * @return Dzien
     */
    public function setGodzina($godzina)
    {
        $this->godzina = $godzina;

        return $this;
    }

    /**
     * Get godzina
     *
     * @return integer 
     */
    public function getGodzina()
    {
        return $this->godzina;
    }

    /**
     * Set dania
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Danie $dania
     * @return Dzien
     */
    public function setDania(\Kalkulator\KalkulatorBundle\Entity\Danie $dania = null)
    {
        $this->dania = $dania;

        return $this;
    }

    /**
     * Get dania
     *
     * @return \Kalkulator\KalkulatorBundle\Entity\Danie 
     */
    public function getDania()
    {
        return $this->dania;
    }
}
