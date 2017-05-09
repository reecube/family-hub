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
            'navigation' => $this->getParsedPages(),
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
     * @return array
     */
    public function getParsedPages()
    {
        $pages = [];

        foreach (Pages::PAGES as &$page) {
            $pages[] = $this->parsePage($page);
        }

        return $pages;
    }

    /**
     * @param int $id
     * @param mixed $default
     * @return array
     */
    public function getParsedPage($id, $default = null)
    {
        $pages = Pages::PAGES;

        if (!isset($pages[$id])) {
            return $default;
        }

        return $this->parsePage($pages[$id]);
    }

    /**
     * @param array $page
     * @return array
     */
    protected function parsePage(array &$page)
    {
        if (!isset($page[Pages::KEY_ROUTE])) {
            $page[Pages::KEY_ROUTE] = $page[Pages::KEY_NAME];
        }
        if (!isset($page[Pages::KEY_TITLE])) {
            $page[Pages::KEY_TITLE] = "page.{$page[Pages::KEY_NAME]}.title";
        }
        $page[Pages::KEY_TITLE] = $this->get('translator')->trans($page[Pages::KEY_TITLE]);

        return $page;
    }

    /**
     * @return bool
     */
    public function isAuthenticatedFully()
    {
        return $this->isGranted('IS_AUTHENTICATED_FULLY');
    }
}
