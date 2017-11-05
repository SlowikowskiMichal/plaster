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
     * @Route("/pacjent/home")
     */
    public function showHome()
    {
        $level = 'pacjent';

        $options = [
            'Home',
            'Historia',
            'Recepty',
            'Wizyty',
            'Lekarze',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/pacjent/home.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/pacjent/apteki")
     */
    public function showApteki()
    {
        $level = 'pacjent';

        $options = [
            'Home',
            'Historia',
            'Recepty',
            'Wizyty',
            'Lekarze',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/pacjent/apteki.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/pacjent/historia")
     */
    public function showHistory()
    {
        $level = 'pacjent';

        $options = [
            'Home',
            'Historia',
            'Recepty',
            'Wizyty',
            'Lekarze',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/pacjent/historia.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/pacjent/lekarze")
     */
    public function showLekarze()
    {
        $level = 'pacjent';

        $options = [
            'Home',
            'Historia',
            'Recepty',
            'Wizyty',
            'Lekarze',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/pacjent/lekarze.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/pacjent/leki")
     */
    public function showLeki()
    {
        $level = 'pacjent';

        $options = [
            'Home',
            'Historia',
            'Recepty',
            'Wizyty',
            'Lekarze',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/pacjent/leki.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/pacjent/recepty")
     */
    public function showRecepty()
    {
        $level = 'pacjent';

        $options = [
            'Home',
            'Historia',
            'Recepty',
            'Wizyty',
            'Lekarze',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/pacjent/recepty.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }

    /**
     * @Route("/pacjent/wizyty")
     */
    public function showWizyty()
    {
        $level = 'pacjent';

        $options = [
            'Home',
            'Historia',
            'Recepty',
            'Wizyty',
            'Lekarze',
            'Apteki',
            'Leki'
        ];

        return $this->render('logged/pacjent/wizyty.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }
}