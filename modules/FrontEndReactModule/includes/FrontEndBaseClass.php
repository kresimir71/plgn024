<?php

namespace Plgn024\Core\modules\FrontEndReactModule\includes;

use Plgn024\Core\modules\BaseClass;

class FrontEndBaseClass extends BaseClass {

	protected $plugin;

	protected function __construct() {

		$this->plugin = PLGNMAIN024(); // it is Main::instance();
		
	}
	
	protected function plugin() {
		return $this->plugin;
	}
	
}
