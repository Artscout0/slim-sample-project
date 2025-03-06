<?php

namespace Slicettes\Models;

use Slicettes\Interfaces\IActiveRecord;

class Image extends ActiveRecord implements IActiveRecord
{
    public int $id;
    public int $recipeId;
    public string $imagePath;

    protected static $table = 'image';

    public function getRecipe() : Recipe {

        return Recipe::findById($this->id);
    }

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

            $sql = "INSET INTO " . $this->table . " (recipeId, imagePath) VALUES (:recipeId, :imagePath)";

            $this->executeQuery($sql, [
                ':recipeId' => $this->recipeId,
                ':imagePath' => $this->imagePath,
            ]);
            $this->commit();
            $this->id = $this->pdoConnection->lastInsertId();
        } catch (\Exception $ex) {
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

            $sql = "UPDATE " . $this->table . "SET recipeId = :recipeId, imagePath = :imagePath WHERE id = :id";

            $this->executeQuery($sql, [
                ':recipeId' => $this->recipeId,
                ':imagePath' => $this->imagePath,
                ':id' => $this->id
            ]);
            $this->commit();
        } catch (\Exception $ex) {
            $this->rollBack();
            throw $ex;
        }
    }
}
