<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * GodzinyPrzyjec
 *
 * @ORM\Table(name="godziny_przyjec")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GodzinyPrzyjecRepository")
 */
class GodzinyPrzyjec
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
     * @ManyToOne(targetEntity="Lekarz")
     * @JoinColumn(name="lekarz_id", referencedColumnName="id", nullable=false)
     */
    private $lekarz;

    /**
     * @ManyToOne(targetEntity="Tydzien")
     * @JoinColumn(name="tydzien_id", referencedColumnName="id", nullable=false)
     */
    private $tydzien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="time")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="time")
     */
    private $end;


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
    public function getTydzien()
    {
        return $this->tydzien;
    }

    /**
     * @param mixed $tydzien
     */
    public function setTydzien($tydzien)
    {
        $this->tydzien = $tydzien;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     *
     * @return GodzinyPrzyjec
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return GodzinyPrzyjec
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }
}

