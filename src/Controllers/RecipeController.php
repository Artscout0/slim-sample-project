<?php

namespace Slicettes\Controllers;

use LDAP\Result;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class RecipeController extends BaseController
{
    function viewAddRecipe(Request $request, Response $response, array $args) {
        return $this->view->render($response, 'Recipe/form.php');
    }

    function saveRecipe(Request $request, Response $response, array $args) {
        
        // ----------------- VALIDATE FORM --------------------
        
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $number = filter_input(INPUT_POST, 'portions', FILTER_SANITIZE_NUMBER_INT);
        $difficulty = filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $errors = [];
        if (!isset($title, $desc, $number, $difficulty)) {
            $errors[] = "Tous les champs doivent avoir des valeurs!";
        }

        if (!in_array($difficulty, ['easy', 'average', 'hard'])) {
            $errors['difficulty']  = "Il faut utiliser une valeur existante pour la difficultée";
        }

        
        if (strlen((string)$number) == 0) {
            $errors['number'] = "Doit être un numero";
        }

        // it'll be discarded if it fails, and used created if it doesn't.
        $id = uniqid();

        $data = [
            'id' => $id,
            'recipe_title' => $title,
            'desc' => $desc,
            'number' => $number,
            'difficulty' => $difficulty
        ];
        
        if (count($errors) > 0) {
            $data['errors'] = $errors;
            return $this->view->render($response, 'Recipe/form.php', $data);
        }

        // ----------------- SAVE FORM & REDIRECT --------------------


        $_SESSION['recipes'][$id] = $data;

        return $this->view->render($response, 'Recipe/valide.php', $data);
    }

    function viewRecipes(Request $request, Response $response, array $args) {
        $data = ['recipes' => $_SESSION['recipes']];

        if (is_null($data)) {
            $data = [];
        }

        return $this->view->render($response, 'Recipe/list.php', $data);
    }

    function viewRecipe(Request $request, Response $response, array $args)
    {
        $data = $_SESSION['recipes'][$args['id']];

        if (is_null($data)) {
            $ctrl = new UtilsController();
            
            return $ctrl->error($request, $response, ['code' => 404, 'message' => 'Recipe not found']);
        }

        return $this->view->render($response, 'Recipe/detail.php', $data);
    }

    function viewDeleteRecipe(Request $request, Response $response, array $args) {
        $data = $_SESSION['recipes'][$args['id']];
        var_dump($request->getMethod());


        if (is_null($data)) {
            $ctrl = new UtilsController();
            
            return $ctrl->error($request, $response, ['code' => 404, 'message' => 'Recipe not found']);
        }

        return $this->view->render($response, 'Recipe/delete.php', $data);

    }

    function deleteRecipe(Request $request, Response $response, array $args) {

        var_dump($request->getMethod());
        unset($_SESSION['recipes'][$args['id']]);

        return $response
            ->withHeader('Location', '/homepage')
            ->withStatus(302);
    }
}
