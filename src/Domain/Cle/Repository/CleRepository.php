<?php

namespace App\Domain\Cle\Repository;

use App\Factory\LoggerFactory;
use PDO;
use PhpParser\Node\Expr\Cast\Bool_;

/**
 * Repository.
 */
class CleRepository
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection, LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory
            // Le nom de fichier de log utilisé
            ->addFileHandler('cle.log')
            // On peut passer du texte en parametre ici qui identifiera
            // la ligne de log, sinon un UUID sera utilisé
            ->createLogger('Clemant');

        $this->connection = $connection;
    }

    /**
     * Indique si la clée fournie existe dans la BD
     *
     * @param cle la clée d'api
     *
     * @return bool si oui ou non la clé existe
     */
    public function CleExiste(string $cle) : bool {

        if($cle == '') {
            return false;
        }

        $sql = "SELECT * FROM usager WHERE cle_api = :cleapi;";
        $params = ['cleapi' => $cle];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $this->logger->debug($query->rowCount());
        $this->logger->debug($query->rowCount() > 0);
        return ($query->rowCount() > 0);
    }

    /**
     * Indique le mot de passe d'un usager
     *
     * @param string $username le nom d'usager
     * @return mixed|string le mot de passe hashé
     */
    public function GetPasswordOfUser(string $username) {

        $sql = "SELECT password FROM usager WHERE username = :username;";
        $params = ['username' => $username];

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultat[0]['password'] ?? "";
    }

    /**
     * Change la clé d'api d'un usager
     *
     * @param string $username le nom d'utilisateur
     * @param string $cle la clé d'api
     * @return bool si le changement à été réussi
     */
    public function InsertNewKeyForUser(string $username, string $cle) {

        $sql = "UPDATE usager
                SET cle_api = :cle_api
                WHERE username = :username;";

        $params = [
            "cle_api" => $cle,
            "username" => $username
        ];

        $query = $this->connection->prepare($sql);
        $resultat = $query->execute($params);

        return $resultat;
    }
}
