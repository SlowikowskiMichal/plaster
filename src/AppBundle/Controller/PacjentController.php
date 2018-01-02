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
            'active' => "home",
        ));
    }

    /**
     * @Route("/pacjent/apteki", name="pacjentApteki")
     */
    public function showApteki(Request $request)
    {
        $form = $this->createFormBuilder(null)
            ->add(  'name',TextType::class, [
                'label' => "Nazwa",
                'required' => false
            ])
            ->add(  'city',TextType::class, [
                'label' => "Miasto",
                'required' => false
            ])
            ->add(  'street',TextType::class, [
                'label' => "Ulica",
                'required' => false
            ])
            ->add(  'Wyszukaj',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->getData()['name'];
            $city = $form->getData()['city'];
            $street = $form->getData()['street'];

            if($name == null)
                $name = '%';
            if($city == null)
                $city = '%';
            if($street == null)
                $street = '%';

            $aptekaList = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery(
                    'SELECT ap, ad 
                    FROM AppBundle:AdressApteki ad
                    INNER JOIN ad.apteka ap
                    WHERE ap.name LIKE :name
                    AND ad.miasto LIKE :city
                    AND ad.ulica LIKE :street'
                )
                ->setParameter('name', $name)
                ->setParameter('city', $city)
                ->setParameter('street', $street)
                ->getResult();
        } else {
            $aptekaList = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery(
                    'SELECT ap, ad FROM AppBundle:AdressApteki ad
                 INNER JOIN ad.apteka ap
                 WHERE ap.name = :name'
                )
                ->setParameter('name',"Kwiatek")
                ->getResult();
        }

        return $this->render('logged/pacjent/apteki.html.twig', array(
            'search_form' => $form->createView(),
            'aptekaList' => $aptekaList,
            'active' => "apteki",
        ));
    }

    /**
     * @Route("/pacjent/historia", name="pacjentHistoria")
     */
    public function showHistory()
    {
        return $this->render('logged/pacjent/historia.html.twig', array(
            'active' => "historia",
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

            return $this->render('logged/pacjent/lekarze.html.twig', array(
                'search_form' => $form->createView(),
                'pacjentList' => $lekarzList,
                'active' => "lekarze",
            ));
        }

        return $this->render('logged/pacjent/lekarze.html.twig', array(
            'search_form' => $form->createView(),
            'pacjentList' => $lekarzList,
            'active' => "lekarze",
        ));
    }

    /**
     * @Route("/pacjent/leki", name="pacjentLeki")
     */
    public function showLeki(Request $request)
    {
        $lekiList = null;

        $form = $this->createFormBuilder(null)
            ->add(  'name',TextType::class, [
                'required' => false
            ])
            ->add(  'wyszukaj',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->getData()['name'];

            $name = $name . '%';

            $lekiList = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery(
                    'SELECT l
                    FROM AppBundle:Lek l
                    WHERE l.name LIKE :name
                    ORDER BY l.name ASC')
                ->setParameter('name', $name)

                ->getResult();

            return $this->render('logged/pacjent/leki.html.twig', array(
                'search_form' => $form->createView(),
                'lekiList' => $lekiList,
                'active' => "pacjenci",
            ));
        }

        return $this->render('logged/pacjent/leki.html.twig', array(
            'search_form' => $form->createView(),
            'lekiList' => $lekiList,
            'active' => "leki",
        ));
    }

    /**
     * @Route("/pacjent/recepty", name="pacjentRecepty")
     */
    public function showRecepty()
    {
        return $this->render('logged/pacjent/recepty.html.twig', array(
            'active' => "recepty",
        ));
    }

    /**
     * @Route("/pacjent/wizyty", name="pacjentWizyty")
     */
    public function showWizyty()
    {
        return $this->render('logged/pacjent/wizyty.html.twig', array(
            'active' => "wizyty",
        ));
    }
}