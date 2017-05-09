<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Enum\Pages;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/dinner")
 */
class DinnerController extends BaseController
{
    /**
     * @var int
     */
    protected $pageId = Pages::ID_PAGE_DINNER;

    /**
     * @Route("/")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->renderPage($request);
    }
}
