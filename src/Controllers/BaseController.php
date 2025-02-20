<?php

namespace Slicettes\Controllers;

use Slim\Views\PhpRenderer;
use ShareCount\Models\User;

abstract class BaseController
{
    /**
     * @var PhpRenderer
     */
    protected PhpRenderer $view;

    /**
     * Constructor
     */
    function __construct()
    {
        $this->view = new PhpRenderer(__DIR__ . '/../../Views', [
            'title' => 'SliCettes',
            'withMenu' => true,
        ]);
        
        $this->view->setLayout("layout.php");
    }
}