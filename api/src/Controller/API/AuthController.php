<?php
namespace SLIMAPI\Controller\API;

use function email\sendEmail;
use Slim\Http\Request;
use Slim\Http\Response;
use PHPMailer;


/**
 * Class DocController
 * @package SLIMAPI\Controller
 *
 * NOTE:  Remember to uncomment this line in php.ini
 *        always_populate_raw_post_data = -1
 *
 */
class AuthController extends \SLIMAPI\Controller\AbstractController
{
    private $app;
    private $bonitaServer, $bonitaUser, $bonitaPassword;
    function __construct($app) {
        parent::__construct($app);
        $this->app = $app;
    }


    /**
     * @SWG\post(
     *     path = "/auth",
     *     summary = "Authenticates users",
     *     tags = {"auth"},
     *     description = "Authenticates the user based on parameters passed in",
     *     operationId = "postAuth",
     *     produces = {"application/json"},
     *     @SWG\Parameter(
     *         in = "body",
     *         required = true,
     *         name = "body",
     *         description = "attachment details",
     *         type = "string",
     *         default = "{
                ""user"": ""USERNAME"",
                ""password"": ""PASSWORD""
}"
     *     ),
     *     @SWG\Response (
     *         response = "200",
     *         description = "Valid request",
     *     )
     * )
     */
    public function apiAuth(Request $request, Response $response, $args)
    {
        $body = $request->getParsedBody();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://idcwin.ca/cms/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "site=idcwin&wsHost=www&wsDomain=mgainvestmentservices.com&wsProtocol=https&wfmGroupName=wfmAdvisor&idcGroupName=idcwinAdvisor&wsiGroupName=wsiAdvisor&doRemoteJBossLoginFunctionString=true&doRemoteEWMSLoginFunctionString=true&remoteJBossDomain=CCWEIP01v%3A8080&remoteJBossProtocol=http&currentSiteName=idcwin&username=" . $body['user'] . "&password=" . $body['password'],
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $responseCurl = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $response->withStatus(401)->withJSON(["success" => false, "error" => $err]);
        } else {
            if (strpos($responseCurl, '<title>Login') === false) {
                return $response->withStatus(200)->withJSON(["success" => true]);
            } else {
                return $response->withStatus(401)->withJSON(["success" => false, "error" => $responseCurl]);
            }
        }

    }
}
