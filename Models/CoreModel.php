<?php

class CoreModel
{
    private static $pdo;

    public function __construct()
    {
        if(self::$pdo == NULL)
        {
            self::$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    protected function getPdo()
    {
        return self::$pdo;
    }

    /**
     * @param string $sql Your query
     * @param array $params tableau associatif de type : 'placeholder' => $value
     * @return bool|PDOStatement le resultat de PDOStatement ou false en cas d'erreur
     * @throws PDOException dépend des paramètres 
     */
    protected function makeStatement($sql, $params = array())
    {
        if(count($params) == 0)
        {
            $statement = self::$pdo->query($sql);
        }
        else
        {
            if(($statement = self::$pdo->prepare($sql)) !== false)
            {
                foreach ($params as $placeholder => $value)
                {
                    switch(gettype($value))
                    {
                        case "integer":
                            $type = PDO::PARAM_INT;
                            break;

                        case "boolean":
                            $type = PDO::PARAM_BOOL;
                            break;

                        case "NULL":
                            $type = PDO::PARAM_NULL;
                            break;

                        default:
                            $type = PDO::PARAM_STR;
                    }
                    if($statement->bindValue($placeholder, $value, $type) === false)
                        return false;
                }
                if(!$statement->execute())
                {
                    return false;
                }
            }
        }

        return $statement;
    }

    /**
     * @param string $sql 
     * @param array $params tableau associatif de type : 'placeholder' => $value
     * @param int $fetchStyle
     * @param mixed $fetchArg
     * @return array|bool tableau avec tous les resultats or false s'il y a une erreur
     * @throws PDOException dépend de la config de PDO
     */
    protected function makeSelect($sql, $params = array(), $fetchStyle = PDO::FETCH_ASSOC, $fetchArg = NULL)
    {
        $statement = $this->makeStatement($sql, $params);

        if($statement === false)
        {
            return false;
        }

        $data = is_null($fetchArg) ? $statement->fetchAll($fetchStyle) : $statement->fetchAll($fetchStyle, $fetchArg);
        $statement->closeCursor();

        return $data;
    }
}