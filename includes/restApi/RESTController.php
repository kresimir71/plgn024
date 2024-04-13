<?php


namespace Plgn024\Core\includes\restApi;

use WP_REST_Controller;


abstract class RESTController extends WP_REST_Controller {


	const REST_NAMESPACE = 'plgn024/v1';


	const REST_BASE = '';
}
// https://developer.wordpress.org/reference/functions/register_rest_route/
