<?php

namespace Plgn024\Core\modules\example2module;

use Plgn024\Core\modules\BaseModule;

class Main extends BaseModule {


	protected function define_necessary_hooks() {
	}
	
	protected function define_on_active_hooks() {

		$moduleclass = ModuleClass2::instance();

	}
}
