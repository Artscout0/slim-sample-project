<?php

namespace Slicettes\Models;

use Slicettes\Utils\PDOSingleton;

abstract class ActiveRecord
{
    /**
     * @var \PDO PDO connection to interact with DB.
     */
    protected $pdoConnection;

    /**
     * @var string Name of the table that'll be accessed
     */
    protected static $table;

    public function __construct(array $data = [])
    {
        $pdo = PDOSingleton::getInstance();
        $this->pdoConnection = $pdo->getConnection();

        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value; // Ok, this is a situation where the way variables work makes sense.
                // I still don't appreciate it.
            }
        }
    }

    protected function executeQuery($sql, $params = [])
    {
        // Prepares query
        $stmt = $this->pdoConnection->prepare($sql);

        // Runs it with given params
        $stmt->execute($params);

        // Returns result
        return $stmt;
    }

    /**
     * Gets all instances of the $table in the DB. 
     *
     * @return static[] An array of instances of the child class.
     * 
     */
    public static function findAll()
    {
        $pdo = PDOSingleton::getInstance();

        $table = static::$table;

        $stmt = $pdo->getConnection()->query("SELECT * FROM $table");

        $datas = $stmt->fetchAll();

        $result = [];

        foreach ($datas as $row) {
            // new static allows you to create a new instance of the child. 
            $result[] = new static($row);
        }

        return $result;
    }

    /**
     * Finds an instance of $table by id. This assumes every table has a unique field named id, which is used as a primary key.
     *
     * @param mixed $id
     * 
     * @return [type]
     * 
     */
    public static function findById($id)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE id = :id";

        $pdoInstance = PDOSingleton::getInstance();

        $stmt = $pdoInstance->getConnection()->prepare($sql);

        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($data) {
            return new static($data);
        }
        return null;
    }

    // Both of there are essentially the same, just depends on whether we have an ID or not.
    abstract public function create();
    abstract public function update();

    /**
     * Saves changes to a database, whether they are creating or updating records.
     */
    public function save()
    {
        $reflection = new \ReflectionClass($this); // permet d'obtenir les données d'une classe
        if ($reflection->getProperty('id')->getValue() == null)
            $this->create();
        else
            $this->update();
    }

    /**
     * Begins a transaction, which will do stuff to the database only if you confirm 
     * that you do indeed want whatever to happen to your DB. 
     * Neat for error handling and not fucking up your data.
     */
    public function beginTransaction()
    {
        if (!$this->pdoConnection->inTransaction()) {
            $this->pdoConnection->beginTransaction();
        }
    }

    /**
     * Confirms that the transaction you started previously is allowed to run, 
     * and potentially screw up your data.
     */
    public function commit()
    {
        if ($this->pdoConnection->inTransaction()) {
            $this->pdoConnection->commit();
        }
    }

    /**
     * Use this instead of commit in case you realised the query might fuck up your 
     * data and you don't want that.
     */
    public function rollBack()
    {
        if ($this->pdoConnection->inTransaction()) {
            $this->pdoConnection->rollBack();
        }
    }

    // TODO: Implement joins.
}
