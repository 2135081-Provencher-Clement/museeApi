<?php

namespace App\Domain\Cle\Service;

use App\Domain\Cle\Repository\CleRepository;

/**
 * Service.
 */
final class CleGet
{
    /**
     * @var CleRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CleRepository $repository
     */
    public function __construct(CleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function UserVerify(string $username, string $password) {

        $vraiMotDePasse = $this->repository->GetPasswordOfUser($username);

        return password_verify($password, $vraiMotDePasse);
    }

    public function InsertNewKeyToUser(string $username, string $key) {

        return $this->repository->InsertNewKeyForUser($username, $key);
    }

}
