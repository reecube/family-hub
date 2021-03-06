<?php

namespace AppBundle\Controller;

use AppBundle\Enum\Languages;
use AppBundle\Enum\Pages;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseController extends Controller
{
    /**
     * @var int
     */
    protected $pageId = null;

    /**
     * @var string
     */
    protected $name = null;

    /**
     * @var string
     */
    protected $template = null;

    function __construct()
    {
        if ($this->pageId === null) {
            throw new \Exception('You have to overwrite the base variables!');
        }

        if ($this->name === null) {
            $this->name = Pages::PAGES[$this->pageId][Pages::KEY_NAME];
        }

        if ($this->template === null) {
            $this->template = $this->name . '.html.twig';
        }
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
        $messages = $request->get('messages', []);
        $message = $request->get('message', null);
        if ($message !== null) {
            $messages[] = $message;
        }

        $errors = $request->get('errors', []);
        $error = $request->get('error', null);
        if ($error !== null) {
            $errors[] = $error;
        }

        $context = [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
            'locale' => $request->getLocale(),
            'languages' => $this->getParsedLanguages(),
            'description' => $this->get('translator')->trans("page.{$this->name}.description"),
            'navigation' => $this->getParsedPages(),
            'hasDrawer' => $this->isAuthenticatedFully(),
            'page' => $page,
            'messages' => $messages,
            'errors' => $errors,
        ];

        if ($custom === null) {
            return $context;
        }

        return array_replace_recursive($context, $custom);
    }

    /**
     * @return array
     */
    public function getParsedLanguages()
    {
        $languages = [];

        foreach (Languages::LANGUAGES as $langId => $language) {
            $language[Languages::KEY_URL] = $this->generateUrl('app_language_change', [
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
        if (!isset($page[Pages::KEY_METHOD])) {
            $page[Pages::KEY_METHOD] = 'index';
        }
        if (!isset($page[Pages::KEY_ROUTE])) {
            $page[Pages::KEY_ROUTE] = "app_{$page[Pages::KEY_NAME]}_{$page[Pages::KEY_METHOD]}";
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

    /**
     * @param Request $request
     * @param null|array $custom
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderPage(Request $request, $custom = null)
    {
        $context = $this->getViewContext($request, $this->getParsedPage($this->pageId), $custom);

        return $this->render($this->template, $context);
    }
}
