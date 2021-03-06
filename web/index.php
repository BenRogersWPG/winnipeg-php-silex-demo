<?php
// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

// register the TwigServiceProvider so we can render templates using Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/../views',     // changed to reflect the /views dir being sibling to /web
	'twig.options' => array('debug' => true)
));

$app->get('/', function () use ($app) {
	return $app['twig']->render('index.html.twig');
});

$app->post('/hello', function (Request $request) use ($app) {
	$name = $request->get('name');
	return $app['twig']->render('hello.html.twig', array('name' => $name));
});

$app->get('/hello/{name}', function ($name) use ($app) {
	return $app['twig']->render('hello.html.twig', array('name' => $name));
});

$app->run();