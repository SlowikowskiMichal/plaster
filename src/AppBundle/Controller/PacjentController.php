<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 05.11.2017
 * Time: 17:21
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PacjentController extends Controller
{
    /**
     * @Route("/pacjent/home", name="pacjentHome")
     */
    public function showHome()
    {
        return $this->render('logged/pacjent/home.html.twig', array(

        ));
    }

    /**
     * @Route("/pacjent/apteki", name="pacjentApteki")
     */
    public function showApteki()
    {
        return $this->render('logged/pacjent/apteki.html.twig', array(

        ));
    }

    /**
     * @Route("/pacjent/historia", name="pacjentHistoria")
     */
    public function showHistory()
    {
        return $this->render('logged/pacjent/historia.html.twig', array(

        ));
    }

    /**
     * @Route("/pacjent/lekarze", name="pacjentLekarze")
     */
    public function showLekarze()
    {
        return $this->render('logged/pacjent/lekarze.html.twig', array(

        ));
    }

    /**
     * @Route("/pacjent/leki", name="pacjentLeki")
     */
    public function showLeki()
    {
        return $this->render('logged/pacjent/leki.html.twig', array(

        ));
    }

    /**
     * @Route("/pacjent/recepty", name="pacjentRecepty")
     */
    public function showRecepty()
    {
        return $this->render('logged/pacjent/recepty.html.twig', array(

        ));
    }

    /**
     * @Route("/pacjent/wizyty", name="pacjentWizyty")
     */
    public function showWizyty()
    {
        return $this->render('logged/pacjent/wizyty.html.twig', array(

        ));
    }
}