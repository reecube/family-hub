<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/language")
 */
class LanguageController extends BaseController
{
    /**
     * @Route("/{_locale}", requirements={ "_locale": "en|fr|de" })
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function changeAction(Request $request)
    {
        $_locale = $request->attributes->get('_locale');

        return $this->json([
            'success' => $_locale === $request->getLocale(),
        ]);
    }
}
