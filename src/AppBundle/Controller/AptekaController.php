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

        return $this->render('logged/aptekarz/home.html.twig', array(
            'active' => "home",
            'apteka' => $apteka,
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

            $receptaList = $this
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

            $wyniki = array_filter($receptaList);

            if(empty($wyniki)) {
                $this->addFlash("error", "Nie znaleziono leku spełniającego wymagania");
            }

            return $this->render('logged/aptekarz/leki.html.twig', array(
                'search_form' => $form->createView(),
                'lekiList' => $receptaList,
                'active' => "leki",
            ));
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
}