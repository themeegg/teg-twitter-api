<?php
namespace Core\Metabox;
class TEG_Metabox{

    function __construct(){

        defined('ABSPATH') or exit;

        $this->getMetabox();

    }

    function getMetabox(){

        new \Core\Metabox\Twitter\TEG_Twitter_Metabox();

    }

    function __destruct(){

    }

}