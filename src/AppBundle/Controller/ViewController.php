<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Enum\Pages;

class ViewController extends BaseController
{
    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/", name="index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('index.html.twig', $this->getViewContext($request, $this->getParsedPage(Pages::ID_PAGE_INDEX)));
    }

    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/demo", name="demo")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function demoAction(Request $request)
    {
        return $this->render('demo.html.twig', $this->getViewContext($request, $this->getParsedPage(Pages::ID_PAGE_DEMO)));
    }
}
