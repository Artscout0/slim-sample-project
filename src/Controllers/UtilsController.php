<?php

namespace Slicettes\Controllers;

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UtilsController extends BaseController{

    public function error(Request $request, Response $response, array $args) {
        return $this->view->render($response, 'Utils/Error.php', $args)->withStatus($args['code']);
    }
}