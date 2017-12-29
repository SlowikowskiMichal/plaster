<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TODO
 * add id_pacjent
 * add id_lekarz
 */

/**
 * Wizyta
 *
 * @ORM\Table(name="wizyta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WizytaRepository")
 */
class Wizyta
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Wizyta
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}

