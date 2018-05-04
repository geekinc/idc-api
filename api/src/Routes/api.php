<?php

define("BASE_PATH", ($_SERVER['SERVER_ADDR'] === '192.168.33.10') ? "/api" : "/api");
define("BASE_SCHEMES", ($_SERVER['SERVER_ADDR'] === '192.168.33.10') ? "http":  "http");
define("AUTH_PATH", ($_SERVER['SERVER_ADDR'] === '192.168.33.10') ? "http://192.168.33.10/api/oauth/dialog":  "http://52.40.80.210:8080/api/oauth/dialog");

/**
 * @SWG\Swagger(
 *     schemes={BASE_SCHEMES},
 *     basePath=BASE_PATH,
 *     @SWG\Info(
 *         version="1.3.1",
 *         title="IDC API",
 *         description="The internal system api.  This integrates the various components of the software together in a consistent interface.",
 *     )
 * )
 */

$app->get('/api/doc', 'SLIMAPI\Controller\API\DocController:apiDoc')->setName('SLIMAPI.api.apiDoc');
$app->post('/api/auth', 'SLIMAPI\Controller\API\AuthController:apiAuth')->setName('SLIMAPI.api.apiAuth');

/**
 * @SWG\SecurityScheme(
 *   securityDefinition="api_key",
 *   type="apiKey",
 *   in="header",
 *   name="authorization"
 * )
 */
