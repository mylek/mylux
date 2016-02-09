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
     *      name="kal_dzien_dodaj"
     * )
     * @Template
     */
    public function dzienAction($dzien) {
	if(!empty($dzien)) {
		$dzien = new \DateTime($dzien);
	} else {
		$dzien = new \DateTime('now');
	}

	$DzienRepository = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Dzien');
	$dane = $DzienRepository->getDzien($dzien);

	echo '<pre>';
	print_r($dane);
	die;
        return true;
    }
}
