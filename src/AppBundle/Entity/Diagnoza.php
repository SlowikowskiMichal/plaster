<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Diagnoza
 *
 * @ORM\Table(name="diagnoza")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiagnozaRepository")
 */
class Diagnoza
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
     * @ManyToOne(targetEntity="Choroba")
     * @JoinColumn(name="choroba_id", referencedColumnName="id", nullable=false)
     */
    private $choroba;

    /**
     * @ManyToOne(targetEntity="Pacjent")
     * @JoinColumn(name="pacjent_id", referencedColumnName="id", nullable=false)
     */
    private $pacjent;

    /**
     * @ManyToOne(targetEntity="Lekarz")
     * @JoinColumn(name="lekarz_id", referencedColumnName="id", nullable=false)
     */
    private $lekarz;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

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
     * @return mixed
     */
    public function getChoroba()
    {
        return $this->choroba;
    }

    /**
     * @param mixed $choroba
     */
    public function setChoroba($choroba)
    {
        $this->choroba = $choroba;
    }

    /**
     * @return mixed
     */
    public function getPacjent()
    {
        return $this->pacjent;
    }

    /**
     * @param mixed $pacjent
     */
    public function setPacjent($pacjent)
    {
        $this->pacjent = $pacjent;
    }

    /**
     * @return mixed
     */
    public function getLekarz()
    {
        return $this->lekarz;
    }

    /**
     * @param mixed $lekarz
     */
    public function setLekarz($lekarz)
    {
        $this->lekarz = $lekarz;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}

