<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class VersionController
 *
 * @package AppBundle\Controller
 */
class VersionController extends Controller
{
    /**
     * @Route("/version", name="version")
     */
    public function indexAction(Request $request)
    {
        return new JsonResponse([
            'version' => $this->getParameter('app_version'),
            'client_ips' => $request->getClientIps(),
            'server_ip' => $request->server->get('SERVER_ADDR')
        ]);
    }
}
