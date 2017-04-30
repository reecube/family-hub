<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class LanguageController extends BaseController
{
    /**
     * @Sensio\Bundle\FrameworkExtraBundle\Configuration\Route("/language/{_locale}", name="language",
     *     requirements={
     *         "_locale": "en|fr|de"
     *     })
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function languageAction(Request $request)
    {
        $_locale = $request->attributes->get('_locale');

        return $this->json([
            'success' => $_locale === $request->getLocale(),
        ]);
    }
}
