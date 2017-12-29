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
     * @ManyToOne(targetEntity="Wizyta")
     * @JoinColumn(name="wizyta_id", referencedColumnName="id", nullable=false)
     */
    private $wizyta;

    /**
     * @OneToMany(targetEntity="Choroba")
     * @JoinColumn(name="choroba_id", referencedColumnName="id", nullable=false)
     */
    private $choroba;

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
    public function getWizyta()
    {
        return $this->wizyta;
    }

    /**
     * @param mixed $wizyta
     */
    public function setWizyta($wizyta)
    {
        $this->wizyta = $wizyta;
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
}

