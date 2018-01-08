<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tydzien
 *
 * @ORM\Table(name="tydzien")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TydzienRepository")
 */
class Tydzien
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
     * @var string
     *
     * @ORM\Column(name="dzien", type="string", length=255)
     */
    private $dzien;


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
     * Set dzien
     *
     * @param string $dzien
     *
     * @return Tydzien
     */
    public function setDzien($dzien)
    {
        $this->dzien = $dzien;

        return $this;
    }

    /**
     * Get dzien
     *
     * @return string
     */
    public function getDzien()
    {
        return $this->dzien;
    }
}

