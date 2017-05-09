<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Enum\Pages;

/**
 * @Security("has_role('ROLE_USER')")
 * @Route("/diet")
 */
class DietController extends BaseAdminController
{
    /**
     * @var int
     */
    protected $pageId = Pages::ID_PAGE_DIET;

    /**
     * @var string
     */
    protected $name = 'diet';

    /**
     * @var string
     */
    protected $entityClass = 'AppBundle:Diet';

    /**
     * @var array
     */
    protected $tableProperties = ['title', 'description'];

    /**
     * @Route("/create", name="diet_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        return parent::createAction($request);
    }

    /**
     * @Route("/", name="diet")
     * @Route("/read", name="diet_read")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readAction(Request $request)
    {
        return parent::readAction($request);
    }

    /**
     * @Route("/update/{id}", requirements={"id" = "\d+"}, name="diet_update")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        return parent::updateAction($request);
    }

    /**
     * @Route("/delete/{id}", requirements={"id" = "\d+"}, name="diet_delete")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request)
    {
        return parent::deleteAction($request);
    }
}
