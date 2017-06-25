<?php

defined('ABSPATH') or exit;

$defaultTabKey = 'general';

$tabArr = array(
    $defaultTabKey=>'General',
    'keys'=> 'API Keys',
);

if( !isset( $_GET['tab'] ) ):

    $_GET['tab'] = $defaultTabKey;

endif;

?>

    <?php settings_errors(); ?>
<h2 class="nav-tab-wrapper">
    <?php foreach($tabArr as $key=>$value):  ?>
        <a href="?page=<?php echo $_GET['page'].'&tab='.$key; ?>" class="nav-tab <?php echo $_GET['tab'] == $key ? 'nav-tab-active' : ''; ?>"><?php echo $value; ?></a>
    <?php endforeach; ?>
</h2>

<?php

$filename = 'Sections'.DIRECTORY_SEPARATOR.$_GET['tab'].'.php';

@include_once($filename);
