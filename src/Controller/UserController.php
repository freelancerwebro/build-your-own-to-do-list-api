<?php

namespace App\Controller;

use App\DTO\RegisterUserDTO;
use App\Service\Request\DtoRequestResolver;
use App\Service\UserRegistrationService;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/api/register', name: 'api_user_register', methods: ['POST'])]
    public function register(
        Request $request,
        DtoRequestResolver $resolver,
        UserRegistrationService $registrationService,
        JWTTokenManagerInterface $jwtManager
    ): JsonResponse {
        $dto = $resolver->resolve($request, RegisterUserDTO::class);

        $user = $registrationService->register($dto);

        return $this->json([
            'status' => Response::HTTP_CREATED,
            'message' => 'User registered successfully',
            'data' => [
                'token' => $jwtManager->create($user),
                'user' => [
                    'email' => $dto->email,
                    'name' => $dto->name,
                    'accountType' => $dto->accountType,
                    'country' => $dto->country,
                ],
            ],
        ]);
    }
}
