<?php

namespace Slicettes\Interfaces;

interface IActiveRecord {
    // permanently moved to the abstract class.
    // public static function findById($id);

    public function create();

    public function update();

    public function delete();
}
