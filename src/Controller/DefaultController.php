<?php
/**
 * Created by PhpStorm.
 * User: figof
 * Date: 13/10/2018
 * Time: 10:32
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('home.html.twig');
    }

}