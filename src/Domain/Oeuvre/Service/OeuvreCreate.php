<?php

namespace App\Domain\Oeuvre\Service;

use App\Domain\Oeuvre\Repository\OeuvreRepository;

/**
 * Service.
 */
final class OeuvreCreate
{
    /**
     * @var OeuvreRepository
     */
    private $repository;

    public function __construct(OeuvreRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Ajout d'un oeuvre dans la base de données.
     *
     * @param array $data Les informations à ajouter
     *
     * @return array L'oeuvre ajouté
     */
    public function creeOeuvre(array $data): array
    {

        $oeuvre = $this->repository->creeOeuvre($data);

        return $oeuvre ?? [];
    }


}
