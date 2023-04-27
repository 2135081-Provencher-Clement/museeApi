<?php

namespace App\Domain\Oeuvre\Service;

use App\Domain\Oeuvre\Repository\OeuvreRepository;

/**
 * Service.
 */
final class OeuvreView
{
    /**
     * @var OeuvreRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param OeuvreRepository $repository
     */
    public function __construct(OeuvreRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Sélectionne une oeuvre au hasard.
     *
     * @return array L'oeuvre sélectionné
     */
    public function voirOeuvre(): array
    {

        $oeuvre = $this->repository->selectOeuvre();

        // Tableau qui contient la réponse à retourner à l'usager
        $resultat = [
            "oeuvre" => $oeuvre
        ];

        return $resultat;
    }

    /**
     * Sélectionne tous les oeuvres.
     *
     * @return array Les oeuvres
     */
    public function voirOeuvres(): array
    {

        $oeuvres = $this->repository->selectOeuvres();

        // Tableau qui contient la réponse à retourner à l'usager
        $resultat = [
            "oeuvres" => $oeuvres
        ];

        return $resultat;
    }


}
