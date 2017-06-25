<?php
namespace TEG_Design\Core;
interface TEG_Meta_Box {

    /**
    * Constructor.
    */
    public function __construct();

    /**
    * Meta box initialization.
    */
    public function init_metabox();

    /**
    * Adds the meta box.
    */
    public function add_metabox();

    /**
    * Renders the meta box.
    */
    public function render_metabox( $post );

    /**
     * Handles saving the meta box.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     * @return null
     */
    public function save_metabox( $post_id, $post );


    /**
     * Handles notices the meta box.
     * @return null
     */
    public function admin_notices( );

        function __destruct();

}