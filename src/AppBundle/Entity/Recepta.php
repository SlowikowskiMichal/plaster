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
     * @ManyToOne(targetEntity="Wizyta")
     * @JoinColumn(name="wizyta_id", referencedColumnName="id", nullable=false)
     */
    private $wizyta;

    /**
     * @ManyToOne(targetEntity="Lek")
     * @JoinColumn(name="lek_id", referencedColumnName="id", nullable=false)
     */
    private $lek;

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

