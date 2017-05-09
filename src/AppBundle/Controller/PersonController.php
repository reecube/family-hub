<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Enum\Pages;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/person")
 */
class PersonController extends BaseController
{
    /**
     * @var string
     */
    protected $template = 'person.html.twig';

    /**
     * @var int
     */
    protected $pageId = Pages::ID_PAGE_PERSON;

    /**
     * @Route("/", name="person")
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