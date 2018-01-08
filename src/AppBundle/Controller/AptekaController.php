<?php
/**
 * Created by PhpStorm.
 * User: slovi
 * Date: 05.11.2017
 * Time: 17:21
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Recepta;
use AppBundle\Entity\StanMagazynu;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AptekaController extends Controller
{
    /**
     * @Route("/apteka/home", name="aptekaHome")
     */
    public function showHome()
    {
        $id = $this->getUser()->getId();
        $apteka = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT  ap.name
                FROM AppBundle:Apteka ap
                WHERE ap.user = :id')
            ->setParameter('id', $id)
            ->getResult();

        $lekiList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT  l.name, m.ilosc
                    FROM AppBundle:StanMagazynu m
                      INNER JOIN m.lek l
                      INNER JOIN AppBundle:Apteka ap WITH ap.user = :id
                    WHERE m.apteka = ap.id
                    AND m.ilosc < :ilosc
                    ORDER BY m.ilosc, l.name ASC')
            ->setParameter('id', $id)
            ->setParameter('ilosc', 10)
            ->getResult();


        return $this->render('logged/aptekarz/home.html.twig', array(
            'active' => "home",
            'apteka' => $apteka,
            'lekiList' => $lekiList,
        ));
    }

    /**
     * @Route("/apteka/leki", name="aptekaLeki")
     */
    public function showLeki(Request $request)
    {
            $lekiList = null;

            $form = $this->createFormBuilder(null)
                ->add(  'name',TextType::class, [
                    'label' => "Nazwa Leku",
                    'required' => false
                ])
                ->add(  'wyszukaj',SubmitType::class)
                ->getForm();

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $name = $form->getData()['name'];
                $id = $this->getUser()->getId();
                $name = $this->getAllRecordsIfFieldIsNull($name);

                $lekiList = $this
                    ->getDoctrine()
                    ->getManager()
                    ->createQuery(
                        'SELECT  l.name, m.ilosc, m.cena
                    FROM AppBundle:StanMagazynu m
                      INNER JOIN m.lek l
                      INNER JOIN AppBundle:Apteka ap WITH ap.user = :id
                    WHERE l.name LIKE :name
                    AND m.apteka = ap.id
                    ORDER BY l.name ASC')
                    ->setParameter('name', $name)
                    ->setParameter('id', $id)
                    ->getResult();

                $wyniki = array_filter($lekiList);

                if(empty($wyniki)) {
                    $this->addFlash("error", "Nie znaleziono leku spełniającego wymagania");
                }

                return $this->render('logged/aptekarz/leki.html.twig', array(
                    'search_form' => $form->createView(),
                    'lekiList' => $lekiList,
                    'active' => "leki",
                ));
            }
        return $this->render('logged/aptekarz/leki.html.twig', array(
            'search_form' => $form->createView(),
            'lekiList' => $lekiList,
            'active' => "leki",
        ));
    }

    /**
     * @Route("/apteka/magazyn", name="aptekaMagazyn")
     */
    public function showMagazyn()
    {
        $id = $this->getUser()->getId();
        $lekiList = $this
            ->getDoctrine()
            ->getManager()
            ->createQuery(
                'SELECT  l.name, m.ilosc, m.cena
                    FROM AppBundle:StanMagazynu m
                      INNER JOIN m.lek l
                      INNER JOIN AppBundle:Apteka ap WITH ap.user = :id
                    AND m.apteka = ap.id
                    ORDER BY l.name ASC')
            ->setParameter('id', $id)
            ->getResult();
        return $this->render('logged/aptekarz/magazyn.html.twig', array(
            'lekiList' => $lekiList,
            'active' => "Magazyn",
        ));
    }

    /**
     * @Route("/apteka/recepty", name="aptekaRecepty")
     */
    public function showRecepty(Request $request)
    {
        $receptaList = null;

        $form = $this->createFormBuilder(null)
            ->add(  'lekarz',EntityType::class, [
                'class' => "AppBundle\Entity\Lekarz",
                'label' => "Lekarz ",
                'choice_label' => 'lekarz',
                'required' => false,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add(  'pacjent',EntityType::class, [
                'class' => "AppBundle\Entity\Pacjent",
                'label' => "Pacjent ",
                'choice_label' => 'pacjent',
                'required' => false,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('start', DateType::class,[
                'label' => "Data wydania od ",
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('end', DateType::class,[
                'label' => "do ",
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add(  'wyszukaj',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $this->getUser()->getId();
            $lekarz = $form->getData()['lekarz'];
            $pacjent = $form->getData()['pacjent'];
            $start = $form->getData()['start'];
            $end = $form->getData()['end'];

            $lekarz = $this->getAllRecordsIfFieldIsNull($lekarz);
            $pacjent = $this->getAllRecordsIfFieldIsNull($pacjent);

            $receptaList = $this
                ->getDoctrine()
                ->getManager()
                ->createQuery(
                    'SELECT  r.id,
                              p.imie as pimie, p.nazwisko as pnazwisko,
                              l.imie as limie, l.nazwisko as lnazwisko, l.telephone as ltel,
                              r.date,
                              lek.name as lnamek, m.ilosc
                    FROM AppBundle:Recepta r
                      INNER JOIN AppBundle:Pacjent p WITH r.pacjent = p.id
                      INNER JOIN AppBundle:Lekarz l WITH r.lekarz = l.id
                      INNER JOIN AppBundle:Apteka ap WITH ap.user = :id
                      INNER JOIN AppBundle:StanMagazynu m WITH ap.id = m.apteka
                      INNER JOIN AppBundle:Lek lek WITH m.lek = lek
                    WHERE r.date BETWEEN :start AND :end
                    AND r.zrealizowana = :zrealizowana 
                    AND p.id LIKE :pacjent 
                    AND l.id LIKE :lekarz      
                    AND m.lek = r.lek          
                    ORDER BY r.date ASC')
                ->setParameter('id', $id)
                ->setParameter('zrealizowana', false)
                ->setParameter('pacjent', $pacjent)
                ->setParameter('lekarz', $lekarz)
                ->setParameter('start', $start)
                ->setParameter('end', $end)
                ->getResult();

            $wyniki = array_filter($receptaList);

            if(empty($wyniki)) {
                $this->addFlash("error", "Nie znaleziono recepty spełniającej wymagania");
            }
        }

        return $this->render('logged/aptekarz/recepty.html.twig', array(
            'search_form' => $form->createView(),
            'receptaList' => $receptaList,
            'active' => "recepty",
        ));
    }

    public function  getAllRecordsIfFieldIsNull($param){
        if($param == null){
            $param = "%";
        }

        return $param;
    }

    /**
     * @Route("/apteka/recepty/realizacja/{nrR}", name="zrealizujRecepte")
     */
    public function realizacja(Request $request, $nrR){

        $em = $this->getDoctrine()->getManager();
        $recepta = $em->getRepository(Recepta::class)->find($nrR);

        if(!$recepta) {
            $this->addFlash("error", "Wystąpił błąd. Nie znaleziono recepty w bazie");
        } else {
            $magazyn = $em->getRepository(StanMagazynu::class)->findOneBy(
                ['lek' => $recepta->getLek()]
            );

            if(!$magazyn){
                $this->addFlash("error", "Wystąpił błąd. Wewnętrzny magazyn apteki");
            } else {
                $recepta->setZrealizowana(true);
                $magazyn->setIlosc($magazyn->getIlosc()-1);
                $em->flush();
                $this->addFlash("success", "Recepta została zrealizowana");
            }
        }

        return $this->redirectToRoute('aptekaRecepty');
    }
}