<?php

namespace App\Domain\Oeuvre\Service;

use App\Domain\Oeuvre\Repository\OeuvreRepository;
use stdClass;

/**
 * Service.
 */
final class OeuvreDelete
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
     * Supprime un oeuvre dans la base de données.
     *
     * @param int $id Le id de l'oeuvre à supprimer
     *
     * @return array L'oeuvre supprimé
     */
    public function supprimeOeuvre(int $id): array
    {

        $oeuvreASupprimer = $this->repository->selectOeuvreParId($id);
        $codeStatus = 200;


        if(empty($oeuvreASupprimer)) {
            $codeStatus = 404;
        } else {
            ($this->repository->supprimeOeuvre($id));
        }

        $resultat = [
            "oeuvre" => empty($oeuvreASupprimer) ? new stdClass : $oeuvreASupprimer,
            "codeStatus" => $codeStatus
        ];

        return $resultat;
    }


}
