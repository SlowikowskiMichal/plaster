<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * GodzinyOtwarciaApteki
 *
 * @ORM\Table(name="godziny_otwarcia_apteki")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GodzinyOtwarciaAptekiRepository")
 */
class GodzinyOtwarciaApteki
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
    public function getApteka()
    {
        return $this->apteka;
    }

    /**
     * @param mixed $apteka
     */
    public function setApteka($apteka)
    {
        $this->apteka = $apteka;
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
     * @return GodzinyOtwarciaApteki
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
     * @return GodzinyOtwarciaApteki
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

