<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Http;

use App\Api\Application\Contract\LoadLeadInterface;
use App\Api\Application\Contract\LoadLeadListInterface;
use App\Api\Domain\Exception\EntityNotFoundException;
use App\Api\Infrastructure\Http\Output\HttpErrorMessage;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class LoadLeadListController extends AbstractFOSRestController
{
    private LoadLeadListInterface $loadLeadListUseCase;

    /**
     * @param  LoadLeadListInterface  $loadLeadListUseCase
     */
    public function __construct(LoadLeadListInterface $loadLeadListUseCase)
    {
        $this->loadLeadListUseCase = $loadLeadListUseCase;
    }

    /**
     * @Rest\Get("/api/v1/lead")
     * @return Response
     */
    public function loadLeadList(): Response
    {
        try {
            $response = $this->loadLeadListUseCase->loadList();
            $view = $this->view($response, 200);
        } catch (\Throwable $e) {
            $errorMessage = new HttpErrorMessage();
            $errorMessage->code = 500;
            $errorMessage->message = $e->getMessage();
            $view = $this->view($errorMessage, 500);
        }
        return $this->handleView($view);
    }
}
