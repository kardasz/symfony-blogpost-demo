<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DebugController
 *
 * @package AppBundle\Controller
 */
class DebugController extends Controller
{
    /**
     * @Route("/debug", name="debug")
     */
    public function indexAction(Request $request)
    {
        return new JsonResponse([
            'server' => $request->server->all()
        ]);
    }
}
