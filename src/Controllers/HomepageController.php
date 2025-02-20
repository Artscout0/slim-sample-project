<?php

namespace Slicettes\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageController extends BaseController{

    public function view(Request $request, Response $response, array $args) {

        return $this->view->render($response, 'Homepage/homepage.php');
    }
}