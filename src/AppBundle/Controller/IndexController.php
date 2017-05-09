<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Enum\Pages;

class IndexController extends BaseController
{
    /**
     * @var string
     */
    protected $template = 'index.html.twig';

    /**
     * @var int
     */
    protected $pageId = Pages::ID_PAGE_INDEX;

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/", name="index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->renderPage($request);
    }
}