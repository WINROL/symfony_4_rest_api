<?php

namespace App\Controller;

use App\Entity\Lottery;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LotteryController
 *
 * @Route("/api/v1")
 * @package App\Controller
 */
class LotteryController extends BaseController
{
    /**
     * @Rest\Route("/lottery")
     */
    public function getLotteriesAction()
    {
        $repository = $this->getDoctrine()->getRepository(Lottery::class);

        // query for a single Product by its primary key (usually "id")
        $lottery = $repository->findAll();

        return $this->createApiResponse($lottery);
    }
}
