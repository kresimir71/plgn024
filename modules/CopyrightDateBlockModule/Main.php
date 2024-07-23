<?php

namespace Plgn024\Core\modules\CopyrightDateBlockModule;

use Plgn024\Core\modules\BaseModule;

class Main extends BaseModule {


	protected function define_necessary_hooks() {

		$this->define_hooks();
		
	}
	
	protected function define_on_active_hooks() {

	}

	private function define_hooks() {

          register_block_type( __DIR__ . '/react/build' );
	  
	}
}
