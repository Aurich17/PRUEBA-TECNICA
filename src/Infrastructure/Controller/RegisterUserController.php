<?php
namespace Infrastructure\Controller;

use Application\DTO\RegisterUserRequest;
use Application\UseCase\RegisterUserUseCase;
use Domain\Shared\Exception\InvalidEmailException;
use Domain\Shared\Exception\WeakPasswordException;
use Domain\Shared\Exception\UserAlreadyExistsException;

class RegisterUserController
{
    private RegisterUserUseCase $registerUserUseCase;

    public function __construct(RegisterUserUseCase $registerUserUseCase)
    {
        $this->registerUserUseCase = $registerUserUseCase;
    }

    public function register(array $requestData): void
    {
        header('Content-Type: application/json');

        try {
            $name     = $requestData['name'] ?? '';
            $email    = $requestData['email'] ?? '';
            $password = $requestData['password'] ?? '';

            $registerRequest = new RegisterUserRequest($name, $email, $password);

            $userResponse = $this->registerUserUseCase->execute($registerRequest);

            http_response_code(201);
            echo json_encode([
                'success' => true,
                'data'    => [
                    'id'        => $userResponse->id,
                    'name'      => $userResponse->name,
                    'email'     => $userResponse->email,
                    'createdAt' => $userResponse->createdAt,
                ],
            ]);
        } catch (InvalidEmailException $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error'   => 'Email inválido: ' . $e->getMessage(),
            ]);
        } catch (WeakPasswordException $e) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error'   => 'Contraseña débil: ' . $e->getMessage(),
            ]);
        } catch (UserAlreadyExistsException $e) {
            http_response_code(409);
            echo json_encode([
                'success' => false,
                'error'   => 'El usuario ya existe: ' . $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error'   => 'Error interno del servidor: ' . $e->getMessage(),
            ]);
        }
    }
}