<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 05.11.2017
 * Time: 17:21
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        $id = $this->getUser()->getId();
        $nextWeek = new \DateTime('now +1 week');
        $pacjent = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT  p.imie, p.nazwisko
                FROM AppBundle:Pacjent p
                WHERE p.user = :id')
            ->setParameter('id', $id)
            ->getResult();

        $wizytyList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT l.imie, l.nazwisko, l.telephone, s.name as specjalizacja, w.date, w.time
                    FROM AppBundle:Wizyta w
                    JOIN AppBundle:Pacjent p WITH p.id = w.pacjent
                    JOIN AppBundle:Lekarz l WITH l.id = w.lekarz
                    JOIN AppBundle:Specjalizacja s WITH l.specjalizacja = s.id
                    WHERE p.user = :id
                    AND :now < w.date
                    AND w.date < :nextWeek
                    ORDER BY w.date, w.time ASC')
            ->setParameter('id', $id)
            ->setParameter('now', new \DateTime())
            ->setParameter('nextWeek', $nextWeek)
            ->getResult();

        return $this->render('logged/pacjent/home.html.twig', array(
            'active' => "home",
            'pacjent' => $pacjent,
            'wizytyList' => $wizytyList
        ));
    }

    /**
     * @Route("/pacjent/apteki", name="pacjentApteki")
     */
    public function showApteki(Request $request)
    {
        $aptekaList = null;
        $godzinyOtwarcia = null;

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

                $wyniki = array_filter($aptekaList);

                if(empty($wyniki)) {
                    $this->addFlash("error", "Nie znaleziono apteki spełniającej wymagania");
                } else {
                    $godzinyOtwarcia = $this
                        ->getDoctrine()
                        ->getManager()
                        ->createQuery(
                            "SELECT a.id, t.dzien, g.start, g.end
                    FROM AppBundle:GodzinyOtwarciaApteki g
                    JOIN g.apteka a
                                        JOIN g.tydzien t
                    JOIN AppBundle:AdressApteki ad WITH ad.apteka = a
                    WHERE a.name LIKE :name
                    AND ad.miasto LIKE :city
                    AND ad.ulica LIKE :street")
                        ->setParameter('name', $name)
                        ->setParameter('city', $city)
                        ->setParameter('street', $street)
                        ->getResult();
                }

        }
        return $this->render('logged/pacjent/apteki.html.twig', array(
            'search_form' => $form->createView(),
            'aptekaList' => $aptekaList,
            'godzinyOtwarcia' => $godzinyOtwarcia,
            'active' => "apteki",
        ));
    }

    /**
     * @Route("/pacjent/historia", name="pacjentHistoria")
     */
    public function showHistory()
    {
        $id = $this->getUser()->getId();

        $historiaList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT  l.imie, l.nazwisko, l.telephone, d.date, ch.nazwa
                FROM AppBundle:Diagnoza d
                INNER JOIN AppBundle:Pacjent p WITH p.id = d.pacjent
                INNER JOIN AppBundle:Lekarz l WITH l.id = d.lekarz
                INNER JOIN AppBundle:Choroba ch WITH ch.id = d.choroba
                WHERE p.user = :id
                ORDER BY d.date DESC')
            ->setParameter('id', $id)
            ->getResult();

        return $this->render('logged/pacjent/historia.html.twig', array(
            'active' => "historia",
            'historiaList' => $historiaList
        ));
    }

    /**
     * @Route("/pacjent/lekarze", name="pacjentLekarze")
     */
    public function showLekarze(Request $request)
    {
        $lekarzList = null;
        $godzinyPrzyjec = null;
        $form = $this->createFormBuilder(null)
            ->add(  'imie',TextType::class, [
                'required' => false
            ])
            ->add(  'nazwisko',TextType::class, [
                'required' => false
            ])
            ->add('specjalizacja', EntityType::class, array(
                'class' => 'AppBundle\Entity\Specjalizacja',
                'choice_label' => 'name',
                'label' => "Specjalizacja ",
                'multiple' => false,
                'expanded' => false,
                'required' => false,
            ))
            ->add(  'wyszukaj',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imie = $form->getData()['imie'];
            $nazwisko = $form->getData()['nazwisko'];
            $specjalizacja = $form->getData()['specjalizacja'];
            if($imie == null) {
                $imie = '%';
            }
            if($nazwisko == null) {
                $nazwisko = '%';
            }
            if($specjalizacja == null) {
                $specjalizacja = '%';
            }
            else {
                $specjalizacja = $specjalizacja->getName();
            }

            $lekarzList = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery(
                    "SELECT l, s
                    FROM AppBundle:Lekarz l
                    JOIN l.specjalizacja s
                    WHERE l.imie LIKE :imie
                    AND l.nazwisko LIKE :nazwisko
                    AND s.name LIKE :specjalizacja
                    ORDER BY l.id ASC")
                ->setParameter('imie', $imie)
                ->setParameter('nazwisko', $nazwisko)
                ->setParameter('specjalizacja', $specjalizacja)
                ->getResult();

            $wyniki = array_filter($lekarzList);

            if(empty($wyniki)) {
                $this->addFlash("error", "Nie znaleziono lekarza spełniającego wymagania");
            } else {
                $godzinyPrzyjec = $this
                    ->getDoctrine()
                    ->getManager()
                    ->createQuery(
                        "SELECT l.id, t.dzien, g.start, g.end
                    FROM AppBundle:GodzinyPrzyjec g
                    JOIN g.lekarz l
                    JOIN g.tydzien t
                    JOIN l.specjalizacja s
                    WHERE l.imie LIKE :imie
                    AND l.nazwisko LIKE :nazwisko
                    AND s.name LIKE :specjalizacja
                    ORDER BY l.id ASC")
                    ->setParameter('imie', $imie)
                    ->setParameter('nazwisko', $nazwisko)
                    ->setParameter('specjalizacja', $specjalizacja)
                    ->getResult();
            }

            return $this->render('logged/pacjent/lekarze.html.twig', array(
                'search_form' => $form->createView(),
                'pacjentList' => $lekarzList,
                'godzinyPrzyjec' => $godzinyPrzyjec,
                'active' => "lekarze",
            ));
        }

        return $this->render('logged/pacjent/lekarze.html.twig', array(
            'search_form' => $form->createView(),
            'pacjentList' => $lekarzList,
            'godzinyPrzyjec' => $godzinyPrzyjec,
            'active' => "lekarze",
        ));
    }

    /**
     * @Route("/pacjent/leki", name="pacjentLeki")
     */
    public function showLeki(Request $request) {
        $lekiList = null;

        $form = $this->createFormBuilder(null)
            ->add(  'name',TextType::class, [
                'label' => "Nazwa Leku",
                'required' => false
            ])
            ->add(  'apteka',TextType::class, [
                'label' => "Nazwa Apteki",
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
            ->add(  'wyszukaj',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->getData()['name'];
            $apteka = $form->getData()['apteka'];
            $city = $form->getData()['city'];
            $street = $form->getData()['street'];

            $name = $this->getAllRecordsIfFieldIsNull($name);
            $apteka = $this->getAllRecordsIfFieldIsNull($apteka);
            $city = $this->getAllRecordsIfFieldIsNull($city);
            $street = $this->getAllRecordsIfFieldIsNull($street);

            $lekiList = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery(
                    'SELECT  l.name, m.ilosc, m.cena, ap.name as nameApteki, ad.miasto, ad.ulica, ad.nrBud
                    FROM AppBundle:StanMagazynu m
                      INNER JOIN m.lek l
                      INNER JOIN AppBundle:Apteka ap WITH ap = m.apteka
                      INNER JOIN AppBundle:AdressApteki ad WITH ad.apteka = ap
                    WHERE l.name LIKE :name
                    AND ap.name LIKE :apteka
                    AND ad.miasto LIKE :miasto
                    AND ad.ulica LIKE :ulica
                    ORDER BY l.name ASC')
                ->setParameter('name', $name)
                ->setParameter('apteka', $apteka)
                ->setParameter('miasto', $city)
                ->setParameter('ulica', $street)
                ->getResult();

            $wyniki = array_filter($lekiList);

            if(empty($wyniki)) {
                $this->addFlash("error", "Nie znaleziono leku spełniającego wymagania");
            }

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
        $id = $this->getUser()->getId();

        $receptaList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT  l.name, r.date
                FROM AppBundle:Recepta r
                INNER JOIN AppBundle:Pacjent p WITH p.id = r.pacjent
                INNER JOIN AppBundle:Lek l WITH l.id = r.lek
                WHERE p.user = :id
                AND r.zrealizowana = :zrealizowana')
            ->setParameter('id', $id)
            ->setParameter('zrealizowana', false)
            ->getResult();

        return $this->render('logged/pacjent/recepty.html.twig', array(
            'active' => "recepty",
            'receptaList' => $receptaList,
        ));
    }

    /**
     * @Route("/pacjent/wizyty", name="pacjentWizyty")
     */
    public function showWizyty()
    {
        $id = $this->getUser()->getId();

        $wizytyList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT l.imie, l.nazwisko, l.telephone, s.name as specjalizacja, w.date, w.time
                    FROM AppBundle:Wizyta w
                    JOIN AppBundle:Pacjent p WITH p.id = w.pacjent
                    JOIN AppBundle:Lekarz l WITH l.id = w.lekarz
                    JOIN AppBundle:Specjalizacja s WITH l.specjalizacja = s.id
                    WHERE p.user = :id
                    ORDER BY w.date, w.time ASC')
            ->setParameter('id', $id)
            ->getResult();
        return $this->render('logged/pacjent/wizyty.html.twig', array(
            'active' => "wizyty",
            'wizytyList' => $wizytyList,
        ));
    }

    public function  getAllRecordsIfFieldIsNull($param){
        if($param == null){
            $param = "%";
        }

        return $param;
    }
}