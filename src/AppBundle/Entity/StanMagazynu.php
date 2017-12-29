<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * TODO
 * add id_apteka
 * id_lek
 */

/**
 * StanMagazynu
 *
 * @ORM\Table(name="stan_magazynu")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StanMagazynuRepository")
 */
class StanMagazynu
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
     * @ManyToOne(targetEntity="Apteka")
     * @JoinColumn(name="apteka_id", referencedColumnName="id", nullable=false)
     */
    private $apteka;

    /**
     * @ManyToOne(targetEntity="Lek")
     * @JoinColumn(name="lek_id", referencedColumnName="id", nullable=false)
     */
    private $lek;

    /**
     * @var int
     *
     * @ORM\Column(name="ilosc", type="integer")
     */
    private $ilosc;

    /**
     * @var float
     *
     * @ORM\Column(name="cena", type="float")
     */
    private $cena;


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
     * Set ilosc
     *
     * @param integer $ilosc
     *
     * @return StanMagazynu
     */
    public function setIlosc($ilosc)
    {
        $this->ilosc = $ilosc;

        return $this;
    }

    /**
     * Get ilosc
     *
     * @return int
     */
    public function getIlosc()
    {
        return $this->ilosc;
    }

    /**
     * Set cena
     *
     * @param float $cena
     *
     * @return StanMagazynu
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

        return $this;
    }

    /**
     * Get cena
     *
     * @return float
     */
    public function getCena()
    {
        return $this->cena;
    }
}

