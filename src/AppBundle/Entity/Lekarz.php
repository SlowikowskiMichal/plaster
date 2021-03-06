<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Lekarz
 *
 * @ORM\Table(name="lekarz")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LekarzRepository")
 */
class Lekarz
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
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @ManyToOne(targetEntity="Specjalizacja")
     * @JoinColumn(name="specjalizacja_id", referencedColumnName="id", nullable=false)
     */
    private $specjalizacja;

    /**
     * @var string
     *
     * @ORM\Column(name="imie", type="string", length=255)
     */
    private $imie;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwisko", type="string", length=255)
     */
    private $nazwisko;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
    * Get lekarz
    *
    * @return string
    */
    public function getLekarz()
    {
        $nazwa = $this->id . " " . $this->specjalizacja->getName() . " "  . $this->imie . " " . $this->nazwisko;
        return $nazwa;
    }

    /**
     * @return mixed
     */
    public function getSpecjalizacja()
    {
        return $this->specjalizacja;
    }

    /**
     * @param mixed $specjalizacja
     */
    public function setSpecjalizacja($specjalizacja)
    {
        $this->specjalizacja = $specjalizacja;
    }

    /**
     * Set imie
     *
     * @param string $imie
     *
     * @return Lekarz
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     *
     * @return Lekarz
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Lekarz
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}

