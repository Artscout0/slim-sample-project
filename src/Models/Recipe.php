<?php

namespace Slicettes\Models;

use Slicettes\Interfaces\IActiveRecord;

class Recipe extends ActiveRecord implements IActiveRecord
{

    protected static $table = 'Recipe';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
    }

    public function create() {}

    public function update() {}

    public function delete() {}
}
