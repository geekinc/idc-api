<?php
namespace SLIMAPI\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ApiController
 * @package SLIMAPI\Controller
 *
 * NOTE:  Remember to uncomment this line in php.ini
 *        always_populate_raw_post_data = -1
 *
 */
class ApiController extends AbstractController
{
    private $app;
    function __construct($app) {
        parent::__construct($app);
        $this->app = $app;
    }

    /**
     * @SWG\Get(
     *     path = "/doc",
     *     summary = "Returns the Swagger JSON definition file",
     *     tags = {"doc"},
     *     description = "Scans the PHP annotations and renders a complete description of the API for Swagger to render",
     *     operationId = "getDoc",
     *     produces = {"application/json"},
     *     @SWG\Response (
     *         response = "200",
     *         description = "Valid request",
     *     )
     * )
     */
    public function apiDoc(Request $request, Response $response, $args)
    {
        @$swagger = \Swagger\scan($app['settings']['BASE_DIR]']) ; //'/var/www/src');
        return $response->withJSON($swagger);
    }

}