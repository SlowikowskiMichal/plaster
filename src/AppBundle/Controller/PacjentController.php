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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

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
        $aptekaList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT ap, ad FROM AppBundle:AdressApteki ad
                 INNER JOIN ad.apteka ap'
            )
            ->getResult();

        return $this->render('logged/lekarz/apteki.html.twig', array(
            'aptekaList' => $aptekaList
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
    public function showLekarze(Request $request)
    {
        $lekarzList = null;

        $form = $this->createFormBuilder(null)
            ->add(  'imie',TextType::class, [
                'required' => false
            ])
            ->add(  'nazwisko',TextType::class, [
                'required' => false
            ])
            ->add(  'wyszukaj',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imie = $form->getData()['imie'];
            $nazwisko = $form->getData()['nazwisko'];

            if($imie == null)
                $imie='%';
            if($nazwisko == null)
                $nazwisko='%';

            $lekarzList = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery(
                    'SELECT l
                    FROM AppBundle:Lekarz l
                    WHERE l.imie LIKE :imie
                    AND l.nazwisko LIKE :nazwisko
                    ORDER BY l.id ASC')
                ->setParameter('imie', $imie)
                ->setParameter('nazwisko', $nazwisko)
                ->getResult();

            return $this->render('logged/lekarz/pacjenci.html.twig', array(
                'search_form' => $form->createView(),
                'pacjentList' => $lekarzList
            ));
        }

        return $this->render('logged/lekarz/pacjenci.html.twig', array(
            'search_form' => $form->createView(),
            'pacjentList' => $lekarzList
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