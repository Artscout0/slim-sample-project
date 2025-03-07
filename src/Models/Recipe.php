<?php

namespace Slicettes\Models;

use Exception;
use Slicettes\Interfaces\IActiveRecord;

class Recipe extends ActiveRecord implements IActiveRecord
{

    public int $id;
    public string $title;
    public string $desc;
    public int $number;
    public string $difficulty;

    protected static $table = 'Recipe';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    /**
     * Sample create function. It creates. This needs to be adjusted based on the table structure.
     * 
     * @throws Exception Generally throws exceptions when there are problems with the database, or the data you're trying to give it
     */
    public function create()
    {
        try {
            $this->beginTransaction();
            $sql = "INSERT INTO " . $this->table . " (title, description, nbPortions, difficulty) VALUES (:title, :desc, :number, :diff)";

            $this->executeQuery($sql, [
                ':title' => $this->title,
                ':desc' => $this->desc,
                ':number' => $this->number,
                ':diff' => $this->difficulty,
            ]);
            $this->commit();
            $this->id = $this->pdoConnection->lastInsertId();
        } catch (Exception $ex) {
            $this->rollBack();
            throw $ex;
        }
    }

    /**
     * Sample update funtion. It updates. This also needs to be adjusted based on the table structure.
     * 
     * @throws Exception Generally throws exceptions when there are problems with the database, or the data you're trying to give it
     */
    public function update()
    {
        try {
            $this->beginTransaction();
            $sql = "UPDATE " . $this->table . " SET title = :title, description = :desc, nbPortions = :number, difficulty = :diff WHERE id = :id;";

            $this->executeQuery($sql, [
                ':title' => $this->title,
                ':desc' => $this->desc,
                ':number' => $this->number,
                ':diff' => $this->difficulty,
                ':id' => $this->id,
            ]);
            $this->commit();
        } catch (\Exception $ex) {
            $this->rollBack();
            throw $ex;
        }
    }

    // The lack of 'delete' (from IActiveRecord) doesn't error, as we have in ActiveRecord. I think.

}
