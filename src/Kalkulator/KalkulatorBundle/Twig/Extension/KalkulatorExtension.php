<?php

namespace Kalkulator\KalkulatorBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\Definition;

class KalkulatorExtension extends \Twig_Extension{
    public function getName() {
        return 'kalkulator_kalkulator_extension';
    }
    
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('kakulator_menu', array($this, 'menu'), array('is_safe' => array('html')))
        );
    }
    
    public function initRuntime(\Twig_Environment $environment) {
        $this->environment = $environment;
    }
    
    public function menu() {
        $menu = array(
            'Dodaj posiłek' => array(
                'class' => 'fa fa-plus-square',
                'submenu' =>   array(
                        'Dodaj posiłek' => 'kal_danie_dodaj'
                    )
            ),
            'Produkty' => array(
                'class' => 'fa fa-th-large',
                'submenu' =>   array(
                        'Lista produktów' => 'kal_produkty_lista',
                        'Dodaj produkt' => 'kal_produkty_dodaj',
                    )
            ),
        );
        
        return $this->environment->render('KalkulatorKalkulatorBundle:Template:menu.html.twig', array(
            'menu' => $menu
        ));
    }
}

