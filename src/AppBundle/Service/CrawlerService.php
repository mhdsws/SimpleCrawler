<?php

namespace AppBundle\Service;

class CrawlerService
{
    private $page_url;

    public function sendCrawler($page_url)
    {
        $this->page_url = $page_url;
        // loading Mink drivers
        $driver = new \Behat\Mink\Driver\GoutteDriver();
        $session = new \Behat\Mink\Session($driver);
        // start the session
        $session->start();

        $session->visit($page_url);
        $status_code =  $session->getStatusCode();
        $page_html = $session->getPage();
        $tableHeaders = $page_html->findAll('css', '.views-element-container > .view-schedules');
        return $tableHeaders;

    }
}

?>