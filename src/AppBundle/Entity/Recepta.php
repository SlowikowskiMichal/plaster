<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * TODO
 * add id_wizyta
 */

/**
 * Recepta
 *
 * @ORM\Table(name="recepta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReceptaRepository")
 */
class Recepta
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
     * @ManyToOne(targetEntity="Lek")
     * @JoinColumn(name="lek_id", referencedColumnName="id", nullable=false)
     */
    private $lek;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="zrealizowana", type="boolean")
     */
    private $zrealizowana;


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
     * @return mixed
     */
    public function getLek()
    {
        return $this->lek;
    }

    /**
     * @param mixed $lek
     */
    public function setLek($lek)
    {
        $this->lek = $lek;
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

    /**
     * Set zrealizowana
     *
     * @param boolean $zrealizowana
     *
     * @return Recepta
     */
    public function setZrealizowana($zrealizowana)
    {
        $this->zrealizowana = $zrealizowana;

        return $this;
    }

    /**
     * Get zrealizowana
     *
     * @return bool
     */
    public function getZrealizowana()
    {
        return $this->zrealizowana;
    }
}

