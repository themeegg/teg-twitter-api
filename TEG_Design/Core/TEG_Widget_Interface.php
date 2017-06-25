<?php
namespace TEG_Design\Core;
interface TEG_Widget_Interface{
    function __construct();
    public function widget($args, $instance);
    public function update($new_instance, $old_instance);
    public function form($instance);
    function __destruct();
}