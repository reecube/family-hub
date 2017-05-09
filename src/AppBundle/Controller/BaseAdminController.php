<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseAdminController extends BaseController
{
    /**
     * @var string
     */
    protected $entityClass = null;

    /**
     * @var array
     */
    protected $propertiesRead = null;

    /**
     * @var array
     */
    protected $propertiesEdit = null;

    /**
     * @param bool $edit
     */
    protected final function setAdminTemplate($edit = false)
    {
        if ($edit) {
            $this->template = 'ext/layout-edit.html.twig';
        } else {
            $this->template = 'ext/layout-read.html.twig';
        }
    }

    function __construct()
    {
        parent::__construct();

        if ($this->entityClass === null || $this->propertiesRead === null || $this->propertiesEdit === null) {
            throw new \Exception('You have to overwrite the base admin variables!');
        }

        $this->setAdminTemplate();
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function upsertEntity(Request $request)
    {
        $doctrine = $this->getDoctrine();

        $repo = $doctrine->getRepository($this->entityClass);

        $entityId = $request->get('id', null);

        if (is_numeric($entityId)) {
            $entity = $repo->find($entityId);
        } else {
            $entity = null;
        }

        $em = $doctrine->getManager();

        $isPost = $request->isMethod('post');

        if ($isPost) {
            if ($entity === null) {
                $entity = new $this->entityClass;
                $em->persist($entity);
            }

            foreach ($this->propertiesEdit as $property) {
                $newValue = $request->get($property, false);

                if ($newValue === 'true') {
                    $newValue = true;
                }

                $entity->{'set' . ucfirst($property)}($newValue);
            }

            $em->flush();

            return $this->redirectToRoute('app_' . $this->name . '_read', [
                'message' => $this->get('translator')->trans('base.form.success.submit'),
            ]);
        }

        if ($entity === null) {
            $entity = new $this->entityClass;
        }

        /** @var \Doctrine\ORM\Mapping\ClassMetadata $metadata */
        $metadata = $em->getClassMetadata($this->entityClass);

        $allowed = $this->propertiesEdit;

        $fields = array_filter($metadata->fieldMappings, function ($key) use ($allowed) {
            return in_array($key, $allowed);
        }, ARRAY_FILTER_USE_KEY);

        $this->setAdminTemplate(true);

        $subPageContext = $entity->getId() === null ? 'create' : 'update';

        return $this->renderPage($request, [
            'name' => $this->name,
            'entity' => $entity,
            'fields' => $fields,
            'page' => [
                'subtitle' => "base.{$subPageContext}.title",
            ],
        ]);
    }

    /**
     * @Route("/create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        return $this->upsertEntity($request);
    }

    /**
     * @Route("/")
     * @Route("/read")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository($this->entityClass);

        return $this->renderPage($request, [
            'name' => $this->name,
            'entities' => $repo->findAll(),
            'properties' => $this->propertiesRead,
        ]);
    }

    /**
     * @Route("/update/{id}", requirements={"id" = "\d+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        return $this->upsertEntity($request);
    }

    /**
     * @Route("/delete/{id}", requirements={"id" = "\d+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository($this->entityClass);

        $entity = $repo->find($request->get('id'));

        if ($entity === null) {
            return $this->redirectToRoute('app_' . $this->name . '_read', [
                'error' => $this->get('translator')->trans('base.form.error.delete'),
            ]);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        return $this->redirectToRoute('app_' . $this->name . '_read', [
            'message' => $this->get('translator')->trans('base.form.success.delte'),
        ]);
    }
}
