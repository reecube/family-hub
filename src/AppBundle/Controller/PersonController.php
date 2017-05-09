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
class PersonController extends BaseAdminController
{
    /**
     * @var int
     */
    protected $pageId = Pages::ID_PAGE_PERSON;

    /**
     * @var string
     */
    protected $name = 'person';

    /**
     * @var string
     */
    protected $entityClass = 'AppBundle:Person';

    /**
     * @var array
     */
    protected $tableProperties = ['nickname', 'firstname', 'lastname', 'user'];

    /**
     * @Route("/create", name="person_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        return parent::createAction($request);
    }

    /**
     * @Route("/", name="person")
     * @Route("/read", name="person_read")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readAction(Request $request)
    {
        return parent::readAction($request);
    }

    /**
     * @Route("/update/{id}", requirements={"id" = "\d+"}, name="person_update")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        return parent::updateAction($request);
    }

    /**
     * @Route("/delete/{id}", requirements={"id" = "\d+"}, name="person_delete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request)
    {
        return parent::deleteAction($request);
    }
}