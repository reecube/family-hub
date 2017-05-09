<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseAdminController extends BaseController
{
    /**
     * @var string
     */
    protected $name = null;

    /**
     * @var string
     */
    protected $entityClass = null;

    /**
     * @var array
     */
    protected $tableProperties = null;

    /**
     * @param bool $edit
     */
    protected final function setTemplate($edit = false)
    {
        if ($edit) {
            $this->template = $this->name . '.html.twig';
        } else {
            $this->template = 'ext/layout-table.html.twig';
        }
    }

    function __construct()
    {
        if ($this->name === null || $this->entityClass === null || $this->tableProperties === null) {
            throw new \Exception('You have to overwrite the base admin variables!');
        }

        $this->setTemplate();
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

        $this->setTemplate(true);

        return $this->renderPage($request, [
            'pagePrefix' => 'page.' . $this->name,
            'entity' => $entity,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        return $this->upsertEntity($request);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function readAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository($this->entityClass);

        return $this->renderPage($request, [
            'pagePrefix' => 'page.' . $this->name,
            'entities' => $repo->findAll(),
            'properties' => $this->tableProperties,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request)
    {
        return $this->upsertEntity($request);
    }

    /**
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
