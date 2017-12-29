<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TODO
 * add id_wizyta
 */

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

