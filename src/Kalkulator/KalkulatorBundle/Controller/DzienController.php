<?php

namespace Kalkulator\KalkulatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Air\BlogBundle\Entity\Dzien;

/**
 * @Route("/kalkulator/dzien")
 */
class DzienController extends Controller {

    /**
     * @Route(
     *      "/{dzien}",
     *      name="kal_dzien_dodaj",
     *      defaults={"dzien" = "now"}
     * )
     * @Template
     */
    public function dzienAction($dzien) {

	// jesli sa cookie to ustawia date
	if('now' == $dzien) {
		$request = Request::createFromGlobals();
		$data = $request->cookies->get('dzien');
		if(!empty($data)) {
			$dzien = $data;		
		}
	}

	$dzien = new \DateTime($dzien);	

	$DzienRepository = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Danie');
	$dane = $DzienRepository->getDzien($dzien);
	$suma = $DzienRepository->getSumaDzien($dzien);

        return array(
		'dzien' => $dane,
		'suma' => $suma
	);
    }
}
