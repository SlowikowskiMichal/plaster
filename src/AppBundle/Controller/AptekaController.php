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

class AptekaController extends Controller
{
    /**
     * @Route("/apteka/home", name="aptekaHome")
     */
    public function showHome()
    {
        return $this->render('logged/aptekarz/home.html.twig', array(
        ));
    }

    /**
     * @Route("/apteka/leki", name="aptekaLeki")
     */
    public function showLeki()
    {
        return $this->render('logged/aptekarz/leki.html.twig', array(

        ));
    }

    /**
     * @Route("/apteka/magazyn", name="aptekaMagazyn")
     */
    public function showMagazyn()
    {
        return $this->render('logged/aptekarz/magazyn.html.twig', array(

        ));
    }

    /**
     * @Route("/apteka/recepty", name="aptekaRecepty")
     */
    public function showRecepty()
    {
        return $this->render('logged/aptekarz/recepty.html.twig', array(
        ));
    }
}