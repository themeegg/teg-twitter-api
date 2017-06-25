<?php
namespace Core\Metabox\Twitter;
class TEG_Twitter_Metabox{

    function __construct(){

        defined('ABSPATH') or exit;

        $this->registerAllTwitterFields();

    }

    public function registerAllTwitterFields(){

        new TEG_Twitter_Settings_Section();

    }

    function __destruct(){

    }

}