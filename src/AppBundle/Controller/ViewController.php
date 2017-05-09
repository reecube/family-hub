<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Enum\Pages;

class ViewController extends BaseController
{
    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/", name="index")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('index.html.twig', $this->getViewContext($request, $this->getParsedPage(Pages::ID_PAGE_INDEX)));
    }

    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/dinner", name="dinner")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dinnerAction(Request $request)
    {
        return $this->render('dinner.html.twig', $this->getViewContext($request, $this->getParsedPage(Pages::ID_PAGE_DINNER)));
    }

    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/persons", name="persons")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function personsAction(Request $request)
    {
        $context = $this->getViewContext($request, $this->getParsedPage(Pages::ID_PAGE_PERSONS), [
            'persons' => [
                'Test',
            ],
        ]);

        return $this->render('persons.html.twig', $context);
    }

    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/diet", name="diet")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dietAction(Request $request)
    {
        return $this->render('diet.html.twig', $this->getViewContext($request, $this->getParsedPage(Pages::ID_PAGE_DIET)));
    }

    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/settings", name="settings")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function settingsAction(Request $request)
    {
        return $this->render('settings.html.twig', $this->getViewContext($request, $this->getParsedPage(Pages::ID_PAGE_SETTINGS)));
    }
}
