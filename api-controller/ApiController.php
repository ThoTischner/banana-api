<?php

if (php_sapi_name() === 'cli-server') {
    // Fixes a weird behaviour of PHP builtin webserver, causing SCRIPT_NAME to equal REQUEST_URI (which causes failed Routing in Slim)
    $_SERVER['SCRIPT_NAME'] = $_SERVER['SCRIPT_FILENAME'];
    if (preg_match('/\.(?:png|jpg|jpeg|gif|svg|ico|css|js)$/', $_SERVER["REQUEST_URI"])) {
        return false;
    }
}

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once '../vendor/autoload.php';

$app = new \Slim\App;
$creator = new \Creator\Creator;

/**
 * @see \BananaService\BananaService::getBananaByLengthRange
 */
$app->get('/banana/bananaByLengthRange', function(Request $request, Response $response, array $args) use ($creator) {
    /** @var $service \BananaService\BananaService */
    $service = $creator->create(\BananaService\BananaService::class);

    /** @var $min float */
    $min = $request->getQueryParam('min');
    
    /** @var $max float */
    $max = $request->getQueryParam('max');

    /** @var $return \BananaService\Model\Banana */
    $return = $service->getBananaByLengthRange($min, $max);

    return $response->withJson(serialize($return));
});

/**
 * @see \BananaService\BananaService::getExoticBanana
 */
$app->get('/banana/exoticBanana', function(Request $request, Response $response, array $args) use ($creator) {
    /** @var $service \BananaService\BananaService */
    $service = $creator->create(\BananaService\BananaService::class);

    

    /** @var $return \BananaService\Model\Banana */
    $return = $service->getExoticBanana();

    return $response->withJson(serialize($return));
});

/**
 * @see \BananaService\BananaService::getRainbowBananaBunch
 */
$app->get('/banana/rainbowBananaBunch', function(Request $request, Response $response, array $args) use ($creator) {
    /** @var $service \BananaService\BananaService */
    $service = $creator->create(\BananaService\BananaService::class);

    

    /** @var $return array */
    $return = $service->getRainbowBananaBunch();

    return $response->withJson($return);
});


$app->run();