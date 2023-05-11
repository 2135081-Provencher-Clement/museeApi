<?php

namespace App\Domain\Oeuvre\Repository;

use PDO;

/**
 * Repository.
 */
class OeuvreRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Sélectionne une oeuvre au hasard
     *
     * @return DataResponse
     */
    public function selectOeuvre(): array
    {
        $sql = "SELECT id, titre, urlImage FROM oeuvre ORDER BY RAND() LIMIT 1;";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function selectOeuvreParId($id): array
    {
        $sql = "SELECT id, titre, urlImage FROM oeuvre WHERE id = :id;";
        $params = ['id' => $id];

        $query = $this->connection->prepare($sql);

        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result[0] ?? [];
    }

    /**
     * Sélectionne tous les oeuvres
     *
     * @return DataResponse
     */
    public function selectOeuvres(): array
    {
        $sql = "SELECT id, titre, urlImage FROM oeuvre ORDER BY titre";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Ajoute un oeuvre
     *
     * @param array $data Les données de l'oeuvre
     *
     * @return array Les informations de l'oeuvre ajouté avec son id
     */
    public function creeOeuvre(array $data): array
    {
        $sql = "INSERT INTO oeuvre (titre, urlImage)
                VALUES (:titre, :urlImage);
        ";

        $params = [
            "titre" => $data['titre'] ?? "",
            "urlImage" => $data['urlImage'] ?? "placeholder"
        ];

        $query = $this->connection->prepare($sql);

        $query->execute($params);

        $oeuvreId = $this->connection->lastInsertId();

        $result = ["id" => $oeuvreId];

        $result += $params;

        return $result;
    }

    /**
     * Modifie un oeuvre
     *
     * @param int $id Le id de l'oeuvre à modifier
     * @param array $data Les données de l'oeuvre à modifier
     *
     * @return array L'oeuvre modifié
     */
    public function updateOeuvre(int $id, array $data): array
    {

        $sql = "UPDATE oeuvre
                SET titre = :titre,
                    urlImage = :urlImage
                WHERE id = :id;";

        $params = [
            "id" => $id,
            "titre" => $data['titre'] ?? "",
            "urlImage" => $data['urlImage'] ?? "placeholder.jpg"
        ];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = ["id" => $id];

        $result += $params;

        return $result;
    }

    /**
     * Supprime un oeuvre selon son id
     *
     * @param int $id Le id de l'oeuvre à supprimer
     *
     * @return bool La suppression à réussi
     */
    public function supprimeOeuvre(int $id): bool
    {
        $params = ['id' => $id];
        $sql = "DELETE FROM oeuvre WHERE id = :id";

        $query = $this->connection->prepare($sql);
        $result = $query->execute($params);

        return $result;
    }

}

