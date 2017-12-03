<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\CrawlerService;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, CrawlerService $Crawler)
    {
        

        $page_url = "https://www.fitnessfirst.de/kurse/kursplan?club_id=86%2C16";

        $tableHeaders = $Crawler->sendCrawler($page_url);

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'page_url' => $page_url,
            'tableHeaders' => $tableHeaders
        ]);
    }
}
