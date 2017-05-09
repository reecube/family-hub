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
}
