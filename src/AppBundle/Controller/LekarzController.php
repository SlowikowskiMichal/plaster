<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 05.11.2017
 * Time: 17:20
 */

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Pacjent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class LekarzController extends Controller
{
    /**
     * @Route("/lekarz/home", name="lekarzHome")
     */
    public function showHome()
    {
        return $this->render('logged/lekarz/home.html.twig', array(

        ));
    }

    /**
     * @Route("/lekarz/apteki", name="lekarzApteki")
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
     * @Route("/lekarz/leki", name="lekarzLeki")
     */
    public function showLeki()
    {
        return $this->render('logged/lekarz/leki.html.twig', array(

        ));
    }

    /**
     * @Route("/lekarz/pacjenci", name="lekarzPacjenci")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPacjenci(Request $request) {
        $pacjentList = null;

        $form = $this->createFormBuilder(null)
            ->add(  'imie',TextType::class, [
                'required' => false
            ])
            ->add(  'nazwisko',TextType::class, [
                'required' => false
            ])
            ->add(  'pesel',TextType::class, [
                'required' => false
            ])
            ->add(  'wyszukaj',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imie = $form->getData()['imie'];
            $nazwisko = $form->getData()['nazwisko'];
            $pesel = $form->getData()['pesel'];

            if($imie == null)
                $imie='%';
            if($nazwisko == null)
                $nazwisko='%';
            if($pesel == null)
                $pesel='%';

            $pacjentList = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery(
                    'SELECT p
                    FROM AppBundle:Pacjent p
                    WHERE p.imie LIKE :imie
                    AND p.nazwisko LIKE :nazwisko
                    AND p.pesel LIKE :pesel
                    ORDER BY p.id ASC')
                ->setParameter('imie', $imie)
                ->setParameter('nazwisko', $nazwisko)
                ->setParameter('pesel', $pesel)
            ->getResult();

            return $this->render('logged/lekarz/pacjenci.html.twig', array(
                'search_form' => $form->createView(),
                'pacjentList' => $pacjentList
            ));
        }

        return $this->render('logged/lekarz/pacjenci.html.twig', array(
            'search_form' => $form->createView(),
            'pacjentList' => $pacjentList
        ));
    }

    /**
     * @Route("/lekarz/wizyty", name="lekarzWizyty")
     */
    public function showWizyty()
    {
        return $this->render('logged/lekarz/wizyty.html.twig', array(

        ));
    }
}