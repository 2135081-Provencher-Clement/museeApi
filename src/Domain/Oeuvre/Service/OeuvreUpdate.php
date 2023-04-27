<?php

namespace App\Domain\Oeuvre\Service;

use App\Domain\Oeuvre\Repository\OeuvreRepository;

/**
 * Service.
 */
final class OeuvreUpdate
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
     * Modification d'un oeuvre dans la base de données.
     *
     * @param int $id Le id de l'oeuvre à modifier
     * @param array $data Les informations à modifier
     *
     * @return array L'oeuvre ajouté
     */
    public function updateOeuvre(int $id, array $data): array
    {

        $vieilleOeuvre = $this->repository->selectOeuvreParId($id);
        $codeStatus = 200;

        if(empty($vieilleOeuvre)) {

            $oeuvre = $this->repository->creeOeuvre($data);
            $codeStatus = 201;
        } else {

            $oeuvre = $this->repository->updateOeuvre($id, $data);
        }

        $resultat = [
            "oeuvre" => $oeuvre,
            "codeStatus" => $codeStatus
        ];

        return $resultat;
    }


}
