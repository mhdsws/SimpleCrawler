<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // loading Mink drivers
        $driver = new \Behat\Mink\Driver\GoutteDriver();
        $session = new \Behat\Mink\Session($driver);
        // start the session
        $session->start();

        $page_url = "https://www.fitnessfirst.de/kurse/kursplan?club_id=86";
        $session->visit($page_url);
        $status_code =  $session->getStatusCode();
        $page_html = $session->getPage();
        $tableHeaders = $page_html->findAll('css', '.views-element-container > .view-schedules');
        //print_r($tableHeaders->getHtml());

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'page_url' => $page_url,
            'status_code' => $status_code,
            'tableHeaders' => $tableHeaders
        ]);
    }
}
