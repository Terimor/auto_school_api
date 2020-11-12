<?php


namespace App\Controller;


use App\Bridge\RequestUserBridge;
use App\Builder\ResponseBuilder;
use App\Entity\User;
use App\EntityService\UserEntityService;
use App\Exception\WrongCredentialsException;
use App\Validator\UserValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SecurityController extends AbstractController
{
    private UserEntityService $userEntityService;

    public function __construct(
        ResponseBuilder $responseBuilder,
        UserEntityService $userEntityService
    ) {
        $this->userEntityService = $userEntityService;
        parent::__construct($responseBuilder);
    }

    /**
     * @Route("api/login", name="user_login", methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws WrongCredentialsException
     */
    public function login(Request $request): Response
    {
        $email = $request->get(User::FIELD_EMAIL, '');
        $password = $request->get(User::FIELD_PASSWORD, '');

        $user = $this->userEntityService->proceedLogin($email, $password);

        return $this->responseBuilder->buildJsonResponse($user, Response::HTTP_OK, ['Default', User::INCLUSION_GROUP_API_TOKEN]);
}

    /**
     * @Route("api/logout", name="user_logout")
     * @param Request $request
     * @return Response
     */
    public function logout(Request $request): Response
    {
        $this->userEntityService->proceedLogout($request->headers->get(User::HEADER_AUTH_TOKEN_NAME));

        return $this->responseBuilder->buildEmptyResponse();
    }

    /**
     * @Route("api/register", name="user_registration", methods={"POST"})
     * @param Request $request
     * @param RequestUserBridge $requestUserBridge
     * @param UserValidator $validator
     * @return Response
     */
    public function register(
        Request $request,
        RequestUserBridge $requestUserBridge,
        UserValidator $validator
    ): Response
    {
        $user = $requestUserBridge->build($request);

        $validator->validate($user);
        $this->userEntityService->proceedRegistration($user);

        return $this->responseBuilder->buildJsonResponse($user, Response::HTTP_CREATED, ['Default', User::INCLUSION_GROUP_API_TOKEN]);
    }
}