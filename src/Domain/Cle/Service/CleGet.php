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

    /**
     * Vérifie si l'utilisateur existe
     *
     * @param string $username le nom d'utilisateur
     * @param string $password le mot de passe
     * @return bool si l'utilisateur existe
     */
    public function UserVerify(string $username, string $password) {

        $vraiMotDePasse = $this->repository->GetPasswordOfUser($username);

        return password_verify($password, $vraiMotDePasse);
    }

    /**
     * Change la clé d'api d'un utilisateur
     *
     * @param string $username le nom d'utilisateur
     * @param string $key la nouvelle clé d'api
     * @return bool si le changement à été réussi
     */
    public function InsertNewKeyToUser(string $username, string $key) {

        return $this->repository->InsertNewKeyForUser($username, $key);
    }

}
