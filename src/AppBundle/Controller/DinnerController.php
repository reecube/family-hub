<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Week;
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
     * @param int $amount
     * @return Week[]
     */
    protected function getWeeks($amount)
    {
        if ($amount < 1) {
            return [];
        }

        $currentWeek = new Week();
        $weeks = [];

        for ($i = 0; $i < $amount; $i++) {
            $weeks[] = $currentWeek;

            $currentWeek = $currentWeek->getNextWeek();
        }

        return $weeks;
    }

    /**
     * @Route("/")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->renderPage($request, [
            'weeks' => $this->getWeeks(5),
        ]);
    }
}
