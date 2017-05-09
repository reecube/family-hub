<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Enum\Pages;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/persons")
 */
class PersonsController extends BaseController
{
    /**
     * @var string
     */
    protected $template = 'persons.html.twig';

    /**
     * @var int
     */
    protected $pageId = Pages::ID_PAGE_PERSONS;

    /**
     * @Route("/", name="persons")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $repoPerson = $this->getDoctrine()->getRepository('AppBundle:Person');

        return $this->renderPage($request, [
            'persons' => $repoPerson->findAll(),
        ]);
    }
}