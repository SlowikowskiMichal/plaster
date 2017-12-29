<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TODO
 * add id_apteka
 * /

/**
 * AdressApteki
 *
 * @ORM\Table(name="adress_apteki")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdressAptekiRepository")
 */
class AdressApteki
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
     * @var float
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="miasto", type="string", length=255)
     */
    private $miasto;

    /**
     * @var string
     *
     * @ORM\Column(name="ulica", type="string", length=255)
     */
    private $ulica;

    /**
     * @var int
     *
     * @ORM\Column(name="nr_bud", type="integer")
     */
    private $nrBud;


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
     * Set latitude
     *
     * @param float $latitude
     *
     * @return AdressApteki
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return AdressApteki
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set miasto
     *
     * @param string $miasto
     *
     * @return AdressApteki
     */
    public function setMiasto($miasto)
    {
        $this->miasto = $miasto;

        return $this;
    }

    /**
     * Get miasto
     *
     * @return string
     */
    public function getMiasto()
    {
        return $this->miasto;
    }

    /**
     * Set ulica
     *
     * @param string $ulica
     *
     * @return AdressApteki
     */
    public function setUlica($ulica)
    {
        $this->ulica = $ulica;

        return $this;
    }

    /**
     * Get ulica
     *
     * @return string
     */
    public function getUlica()
    {
        return $this->ulica;
    }

    /**
     * Set nrBud
     *
     * @param integer $nrBud
     *
     * @return AdressApteki
     */
    public function setNrBud($nrBud)
    {
        $this->nrBud = $nrBud;

        return $this;
    }

    /**
     * Get nrBud
     *
     * @return int
     */
    public function getNrBud()
    {
        return $this->nrBud;
    }
}

