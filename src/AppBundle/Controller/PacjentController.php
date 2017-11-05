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

        return $this->render('logged/home.html.twig', array(
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

        return $this->render('logged/home.html.twig', array(
            'options' => $options,
            'level' => $level
        ));
    }
}