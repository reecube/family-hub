<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Enum\Pages;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/settings")
 */
class SettingsController extends BaseController
{
    /**
     * @var string
     */
    protected $template = 'settings.html.twig';

    /**
     * @var int
     */
    protected $pageId = Pages::ID_PAGE_SETTINGS;

    /**
     * @Route("/", name="settings")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->renderPage($request);
    }
}