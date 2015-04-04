<?php
namespace ptitdam2001\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController {

	public function indexAction(Request $request, Application $app) {
		return $app->json(array('response' => "OK"));
	} 
}