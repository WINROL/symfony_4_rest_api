<?php
/**
 * Created by PhpStorm.
 * User: smykruslanal
 * Date: 31.07.2018
 * Time: 17:29
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    protected function serialize($data, $format = 'json')
    {
        return $this->container->get('jms_serializer')
            ->serialize($data, $format);
    }

    protected function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->serialize($data);

        return new Response($json, $statusCode, array(
            'Content-Type' => 'application/json'
        ));
    }
}