<?php

declare(strict_types=1);

namespace App\Api\Infrastructure\Http;

use App\Api\Application\Contract\CreateLeadInterface;
use App\Api\Application\Dto\Input\CreateLeadDto;
use App\Api\Domain\Exception\InvalidArgumentException;
use App\Api\Infrastructure\Http\Output\HttpErrorMessage;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;

class CreateLeadController extends AbstractFOSRestController
{
    private CreateLeadInterface $createLeadUseCase;

    /**
     * @param  CreateLeadInterface  $createLeadUseCase
     */
    public function __construct(CreateLeadInterface $createLeadUseCase)
    {
        $this->createLeadUseCase = $createLeadUseCase;
    }

    /**
     * @Rest\Post("/api/v1/lead")
     * @ParamConverter("createLeadDto", converter="fos_rest.request_body")
     * @param  CreateLeadDto  $createLeadDto
     * @return Response
     */
    public function createLead(CreateLeadDto $createLeadDto): Response
    {
        try {
            $response = $this->createLeadUseCase->create($createLeadDto);
            $view = $this->view($response, 201);
        } catch (InvalidArgumentException $e) {
            $errorMessage = new HttpErrorMessage();
            $errorMessage->errorMessage = $e->getMessage();
            $view = $this->view($errorMessage, 400);
        } catch (\Throwable $e) {
            $errorMessage = new HttpErrorMessage();
            $errorMessage->errorMessage = $e->getMessage();
            $view = $this->view($errorMessage, 500);
        }
        return $this->handleView($view);
    }
}
