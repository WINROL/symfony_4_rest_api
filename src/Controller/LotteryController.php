<?php

namespace App\Controller;

use App\Entity\Lottery;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LotteryController
 *
 * @Route("/api/v1")
 * @package App\Controller
 */
class LotteryController extends BaseController
{
    protected function getLottery($lotteryId)
    {
        $repository = $this->getDoctrine()->getRepository(Lottery::class);
        $lottery = $repository->find($lotteryId);
        if (!$lottery) {
            throw new NotFoundHttpException('Lottery not found');
        }

        return $lottery;
    }

    /**
     * @Rest\Route("/lottery/{lotteryId}/participants", requirements={"lotteryID" = "^\d+$"})
     *
     * @param $lotteryId
     * @return Response
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getLotteryParticipantsAction($lotteryId)
    {
        try {
            $lottery = $this->getLottery($lotteryId);
        } catch (NotFoundHttpException $exception) {
            return $this->createApiResponse([], 404);
        }

        $repository = $this->getDoctrine()->getRepository(Lottery::class);
        $lotteryParticipants = $repository->getLotteryParticipants($lottery);

        return $this->createApiResponse($lotteryParticipants);
    }

    /**
     * @Rest\Route(
     *     "/lottery/{lotteryId}/participants/{playerUUID}",
     *     requirements={"lotteryId" = "^\d+$", "playerUUID" = "^\d+$"}
     * )
     *
     * @param $lotteryID
     * @param $playerUUID
     * @return Response
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getLotteryParticipantAction($lotteryId, $playerUUID)
    {
        try {
            $lottery = $this->getLottery($lotteryId);
        } catch (NotFoundHttpException $exception) {
            return $this->createApiResponse([], 404);
        }

        $repository = $this->getDoctrine()->getRepository(Lottery::class);
        $lotteryParticipants = $repository->getParticipantLotteryInfo($lottery);

        return $this->createApiResponse($lotteryParticipants);
    }
}
