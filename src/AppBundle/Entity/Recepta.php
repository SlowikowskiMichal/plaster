<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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

