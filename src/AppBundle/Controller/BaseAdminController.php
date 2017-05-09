<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $repo = $this->getDoctrine()->getRepository($this->entityClass);

        $entity = $repo->find($request->get('id'));

        // TODO: on post: upsert entity

        $this->setAdminTemplate(true);

        return $this->renderPage($request, [
            'name' => $this->name,
            'entity' => $entity,
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
            return new JsonResponse([
                'success' => false,
            ], 400);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        return new JsonResponse([
            'success' => true,
        ]);
    }
}
