<?php
namespace TEG_Design\Core;
interface TEG_Option_Interface{
    function __construct();
    public function addActionHook();
    public function addOptionsPages();
    public function registerThemeOptionGroup();
    public function templates();
    function __destruct();
}