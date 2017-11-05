<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 05.11.2017
 * Time: 17:20
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LekarzController extends Controller
{
    /**
     * @Route("/lekarz/home")
     */
    public function showHome()
    {
        $level = 'lekarz';

        $options = [
            'Home',
            'Pacjenci',
            'Wizyty',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/lekarz/home.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/lekarz/apteki")
     */
    public function showApteki()
    {
        $level = 'lekarz';

        $options = [
            'Home',
            'Pacjenci',
            'Wizyty',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/lekarz/apteki.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/lekarz/leki")
     */
    public function showLeki()
    {
        $level = 'lekarz';

        $options = [
            'Home',
            'Pacjenci',
            'Wizyty',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/lekarz/leki.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/lekarz/pacjenci")
     */
    public function showPacjenci()
    {
        $level = 'lekarz';

        $options = [
            'Home',
            'Pacjenci',
            'Wizyty',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/lekarz/pacjenci.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/lekarz/wizyty")
     */
    public function showWizyty()
    {
        $level = 'lekarz';

        $options = [
            'Home',
            'Pacjenci',
            'Wizyty',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/lekarz/wizyty.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }
}