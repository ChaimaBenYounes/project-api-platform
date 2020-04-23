<?php


namespace App\Security;


use App\Repository\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserConfirmationService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function confirmationUser(string $confirmationToken){
        $user = $this->userRepository->findOneBy(['confirmationToken' => $confirmationToken]);

        if(!$user){
            Throw new NotFoundHttpException();
        }

        $user->setEnabled(true);
        $user->setConfirmationToken(null);
        $this->entityManager->flush();
    }
}
