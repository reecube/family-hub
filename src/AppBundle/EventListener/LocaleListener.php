<?php

namespace AppBundle\EventListener;

use AppBundle\Enum\Languages;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @param string $defaultLocale
     */
    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * @return string
     */
    public function getClientLocale()
    {
        try {
            $locale = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($locale, array_keys(Languages::LANGUAGES))) {
                return $locale;
            }
        } catch (\Exception $ex) {
        }

        return $this->defaultLocale;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            $locale = $this->getClientLocale();
            $request->getSession()->set('_locale', $locale);
            $request->setLocale($locale);
            return;
        }

        // try to see if the locale has been set as a _locale routing parameter
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {

            // if no explicit locale has been set on this request, use one from the session
            $request->setLocale($request->getSession()->get('_locale', $this->getClientLocale()));
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(

            // must be registered after the default Locale listener
            KernelEvents::REQUEST => array(array('onKernelRequest', 15)),
        );
    }
}