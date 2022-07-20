<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Http;

use App\Api\Application\Contract\LoadLeadInterface;
use App\Api\Domain\Exception\EntityNotFoundException;
use App\Api\Infrastructure\Http\Output\HttpErrorMessage;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;

class LoadLeadController extends AbstractFOSRestController
{
    private LoadLeadInterface $loadLeadUseCase;

    /**
     * @param  LoadLeadInterface  $loadLeadUseCase
     */
    public function __construct(LoadLeadInterface $loadLeadUseCase)
    {
        $this->loadLeadUseCase = $loadLeadUseCase;
    }

    /**
     * @Rest\Get("/api/v1/lead/{id}")
     * @param  int $id
     * @return Response
     */
    public function loadLead(int $id): Response
    {
        try {
            $response = $this->loadLeadUseCase->load($id);
            $view = $this->view($response, 200);
        } catch (EntityNotFoundException $e) {
            $errorMessage = new HttpErrorMessage();
            $errorMessage->code = 404;
            $errorMessage->message = $e->getMessage();
            $view = $this->view($errorMessage, 404);
        } catch (\Throwable $e) {
            $errorMessage = new HttpErrorMessage();
            $errorMessage->code = 500;
            $errorMessage->message = $e->getMessage();
            $view = $this->view($errorMessage, 500);
        }
        return $this->handleView($view);
    }
}
