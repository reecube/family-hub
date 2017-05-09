<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
}