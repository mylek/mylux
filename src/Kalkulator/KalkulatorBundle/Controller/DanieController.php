<?php

namespace Kalkulator\KalkulatorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DanieController extends Controller {

    /**
     * @Route(
     *      "/",
     *      name="kal_danie_dodaj",
     * )
     * @Template
     */
    public function dodajAction(Request $Request) {
        $prodObj = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
        $produkty = $prodObj->findBy(array('usun' => 0), array('nazwa' => 'DESC'));
        $Session = $this->get('session');

        if ($Request->isMethod('POST')) {

            $postData = $Request->request->all();
            $produkty_posilek = array();
            if (!empty($postData)) {
		// zapis dnia
		$em = $this->getDoctrine()->getManager();
		$dzien = new \Kalkulator\KalkulatorBundle\Entity\Dzien();
		$dzien->setUser($this->getUser());
		$dzien->setData(new \DateTime($postData['data'] . ' ' . $postData['time']));
		$em->persist($dzien);
                $em->flush();

		if($dzien->getId() > 0) {
			foreach ($postData['produkt'] as $key => $id_produktu)
			{
			    if (!empty($id_produktu) && $postData['gram'][$key] > 0) {
			        $produkty_posilek[] = array(
			            'produkt_id' => $id_produktu,
			            'gram' => $postData['gram'][$key],
			        );
			        $produktObj = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
			        $produktObj = $produktObj->find($id_produktu);
			        if(!$produktObj)
			            continue;
			        
			        $danie = new \Kalkulator\KalkulatorBundle\Entity\Danie();
			        $danie->setGram($postData['gram'][$key]);
			        $danie->setProdukty($produktObj);
				$danie->setDzien($dzien);
			        $em->persist($danie);
			        $em->flush();
			    }
			}
		}
                $Session->getFlashBag()->add('success', 'Posiłek został zapisany');
                $Session->set('registered', true);
            }
        }
        

        return array(
            'produkty' => $produkty
        );
    }

    /**
     * @Route(
     *      "/ajax_pobierz_produkt",
     *      name="kal_danie_ajax_pobierz_produkt",
     * )
     * @Template
     */
    public function ajaxPobierzProduktAction(Request $request) {
        $id = $request->request->get('id');
        $Repo = $this->getDoctrine()->getRepository('KalkulatorKalkulatorBundle:Produkt');
        $produkt = $Repo->find($id);

        $produkt_res = array();
        if ($produkt) {
            $produkt_res = array(
                'kalorii' => $produkt->getKalorii(),
                'porcja' => $produkt->getPorcja(),
                'bialka' => $produkt->getBialka(),
                'wegle' => $produkt->getWegle(),
                'tluszcze' => $produkt->getTluszcze(),
            );
        }

        $response = new Response(json_encode($produkt_res));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /* public function ajaxgetproduktAction() {
      $request = $this->getRequest();
      $response = $this->getResponse();

      if ($request->isPost()) {
      $produktTable = $this->getServiceLocator()->get('ProduktTable');
      $post_data = $request->getPost();
      $produkt = $produktTable->getProdukt($post_data['id']);
      $response->setContent(\Zend\Json\Json::encode($produkt));
      }
      return $response;
      } */
}
