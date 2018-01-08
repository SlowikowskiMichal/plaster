<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 05.11.2017
 * Time: 17:20
 */

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Diagnoza;
use AppBundle\Entity\Lekarz;
use AppBundle\Entity\Pacjent;
use AppBundle\Entity\Recepta;
use AppBundle\Entity\Wizyta;
use AppBundle\Form\WizytaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        $id = $this->getUser()->getId();
        $lekarz = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT  l.imie, l.nazwisko
                FROM AppBundle:Lekarz l
                WHERE l.user = :id')
            ->setParameter('id', $id)
            ->getResult();

        $wizytyList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT p.imie, p.nazwisko, p.telephone, w.date, w.time
                    FROM AppBundle:Wizyta w
                    JOIN AppBundle:Pacjent p WITH p.id = w.pacjent
                    JOIN AppBundle:Lekarz l WITH l.id = w.lekarz
                    WHERE l.user = :id
                    AND :now = w.date
                    ORDER BY w.time ASC')
            ->setParameter('id', $id)
            ->setParameter('now', date_format(new \DateTime(),"Y-m-d"))
            ->getResult();

        return $this->render('logged/lekarz/home.html.twig', array(
            'active' => "home",
            'lekarz' => $lekarz,
            'wizytyList' => $wizytyList,
        ));
    }

    /**
     * @Route("/lekarz/apteki", name="lekarzApteki")
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
        return $this->render('logged/lekarz/apteki.html.twig', array(
            'search_form' => $form->createView(),
            'aptekaList' => $aptekaList,
            'godzinyOtwarcia' => $godzinyOtwarcia,
            'active' => "apteki",
        ));
    }

    /**
     * @Route("/lekarz/leki", name="lekarzLeki")
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

            return $this->render('logged/lekarz/leki.html.twig', array(
                'search_form' => $form->createView(),
                'lekiList' => $lekiList,
                'active' => "pacjenci",
            ));
        }

        return $this->render('logged/lekarz/leki.html.twig', array(
            'search_form' => $form->createView(),
            'lekiList' => $lekiList,
            'active' => "leki",
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
                'pacjentList' => $pacjentList,
                'active' => "pacjenci",
            ));
        }

        return $this->render('logged/lekarz/pacjenci.html.twig', array(
            'search_form' => $form->createView(),
            'pacjentList' => $pacjentList,
            'active' => "pacjenci",
        ));
    }

    /**
     * @Route("/lekarz/wizyty", name="lekarzWizyty")
     */
    public function showWizyty()
    {
        $id = $this->getUser()->getId();

        $wizytyList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT p.imie, p.nazwisko, p.telephone, w.date, w.time
                    FROM AppBundle:Wizyta w
                    JOIN AppBundle:Pacjent p WITH p.id = w.pacjent
                    JOIN AppBundle:Lekarz l WITH l.id = w.lekarz
                    WHERE l.user = :id
                    ORDER BY w.date, w.time ASC')
            ->setParameter('id', $id)
            ->getResult();
        return $this->render('logged/lekarz/wizyty.html.twig', array(
            'active' => "wizyty",
            'wizytyList' => $wizytyList,
        ));
    }

    /**
     * @Route("/lekarz/wizyty/dodaj", name="lekarzDodajWizyty")
     */
    public function addWizyty(Request $request){

        $wizyta = new Wizyta();

        $form = $this->createForm(WizytaType::class,$wizyta, [

        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $lekarz = $this
                ->getDoctrine()
                ->getRepository(Lekarz::class)
                ->findOneBy(
                    ['user'=>$this->getUser()]
                );

            $wizyta->setLekarz($lekarz);

            $em = $this->getDoctrine()->getManager();

            $em->persist($wizyta);
            $em->flush();

            $this->addFlash('success',"Wizyta dodana pomyślnie");
//            return $this->redirectToRoute('login');
        }
        return $this->render('logged/lekarz/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "dodajWizyty",
        ]);
    }

    /**
     * @Route("/lekarz/recepta/dodaj", name="lekarzDodajRecepte")
     */
    public function addRecepta(Request $request){

        $recepta = new Recepta();

        $form = $this->createFormBuilder(null)
            ->add(  'pacjent',EntityType::class, [
                'class' => 'AppBundle\Entity\Pacjent',
                'choice_label' => 'pacjent',
                'label' => 'Pacjent ',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add( 'lek',EntityType::class, [
                'class' => 'AppBundle\Entity\Lek',
                'choice_label' => 'name',
                'label' => 'Lek ',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add(  'Wypisz',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $lekarz = $this
                ->getDoctrine()
                ->getRepository(Lekarz::class)
                ->findOneBy(
                    ['user'=>$this->getUser()]
                );
            $lek = $form->getData()['lek'];
            $pacjent = $form->getData()['pacjent'];

            $recepta->setLekarz($lekarz);
            $recepta->setDate(new  \DateTime());
            $recepta->setZrealizowana(false);
            $recepta->setPacjent($pacjent);
            $recepta->setLek($lek);

            $em = $this->getDoctrine()->getManager();

            $em->persist($recepta);
            $em->flush();

            $this->addFlash('success',"Recepta wypisana pomyślnie");
//            return $this->redirectToRoute('login');
        }
        return $this->render('logged/lekarz/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "dodajRecepte",
        ]);
    }

    /**
     * @Route("/lekarz/diagnoza/dodaj", name="lekarzDodajDiagnoza")
     */
    public function addDiagnoza(Request $request){

        $diagnoza = new Diagnoza();

        $form = $this->createFormBuilder(null)
            ->add(  'pacjent',EntityType::class, [
                'class' => 'AppBundle\Entity\Pacjent',
                'choice_label' => 'pacjent',
                'label' => 'Pacjent ',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add( 'choroba',EntityType::class, [
                'class' => 'AppBundle\Entity\Choroba',
                'choice_label' => 'nazwa',
                'label' => 'Choroba ',
                'required' => true,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add(  'Wypisz',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $lekarz = $this
                ->getDoctrine()
                ->getRepository(Lekarz::class)
                ->findOneBy(
                    ['user'=>$this->getUser()]
                );
            $choroba = $form->getData()['choroba'];
            $pacjent = $form->getData()['pacjent'];

            $diagnoza->setLekarz($lekarz);
            $diagnoza->setDate(new  \DateTime());

            $diagnoza->setPacjent($pacjent);
            $diagnoza->setChoroba($choroba);

            $em = $this->getDoctrine()->getManager();

            $em->persist($diagnoza);
            $em->flush();

            $this->addFlash('success',"Diagnoza dodana pomyślnie");
        }
        return $this->render('logged/lekarz/register.html.twig', [
            'registration_form' => $form->createView(),
            'active' => "dodajDiagnoza",
        ]);
    }
}