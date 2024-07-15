<?php

namespace Plgn024\Core\modules\FrontEndReactModule\includes;

class FrontEnd extends FrontEndBaseClass {

    //echo $this->module->options()->get( 'some_module_option' );
    //echo PLGNMAIN024()->options()->get( 'some_option' );

    public function shortcode_func( $atts ){
	   return '<div id="plgn024-front"></div>';
    }
    
}
