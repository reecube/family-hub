<?php

namespace AppBundle\Controller;

use AppBundle\Enum\Languages;
use AppBundle\Enum\Pages;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseController extends Controller
{

    /**
     * @return bool
     */
    public function isLocal()
    {
        return $_SERVER['HTTP_HOST'] === 'youtube.reecube.local';
    }

    /**
     * @return bool
     */
    public function isDevEnv()
    {
        return $this->container->get('kernel')->getEnvironment() === 'dev';
    }

    /**
     * @param Request $request
     * @param array $page
     * @param array|null $custom
     * @return array
     */
    public function getViewContext(Request $request, array $page, $custom = null)
    {
        $context = [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'locale' => $request->getLocale(),
            'languages' => $this->getParsedLanguages(),
            'description' => 'TODO: description',
            'navigation' => Pages::PAGES,
            'hasDrawer' => $this->isAuthenticatedFully(),
            'page' => $page,
        ];

        if ($custom === null) {
            return $context;
        }

        return array_merge($context, $custom);
    }

    /**
     * @return array
     */
    public function getParsedLanguages()
    {
        $languages = [];

        foreach (Languages::LANGUAGES as $langId => $language) {
            $language[Languages::KEY_URL] = $this->generateUrl('language', [
                '_locale' => $language[Languages::KEY_LOCALE],
            ]);

            $languages[$langId] = $language;
        }

        return $languages;
    }

    /**
     * @return bool
     */
    public function isAuthenticatedFully()
    {
        return $this->isGranted('IS_AUTHENTICATED_FULLY');
    }
}
