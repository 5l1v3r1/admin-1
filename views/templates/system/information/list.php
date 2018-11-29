<?php
namespace Flextype;
use Flextype\Component\{Http\Http, Registry\Registry, Filesystem\Filesystem, Token\Token};
use function Flextype\Component\I18n\__;
?>

<?php
    Themes::view('admin/views/partials/head')->display();
    Themes::view('admin/views/partials/navbar')
        ->assign('links', [
                                'information' => [
                                                    'link' => Http::getBaseUrl() . '/admin/information',
                                                    'title' => __('admin_menu_system_information'),
                                                    'attributes' => ['class' => 'navbar-item active']
                                                 ],
                          ])
        ->display();
    Themes::view('admin/views/partials/content-start')->display();
?>

<h3 class="h3"><?php echo  __('admin_system_settings_site'); ?></h3>

<table class="table no-margin">
    <tbody>
        <tr>
            <td><?php echo __('admin_flextype_version'); ?></td>
            <td><?php echo Flextype::VERSION; ?></td>
        </tr>
        <tr>
            <td><?php echo __('admin_debugging'); ?></td>
            <td><?php if (Registry::get('system.errors.display')) echo __('admin_on'); else echo __('admin_off'); ?></td>
        </tr>
        <tr>
            <td><?php echo __('admin_cache'); ?></td>
            <td><?php if (Registry::get('system.cache.enabled')) echo __('admin_on'); else echo __('admin_off'); ?></td>
        </tr>
    </tbody>
</table>
<br><br>


<h3 class="h3"><?php echo  __('admin_server'); ?></h3>

<table class="table no-margin">
    <tbody>
        <tr>
            <td><?php echo __('admin_php_version'); ?></td>
            <td><?php echo PHP_VERSION; ?></td>
        </tr>
        <tr>
            <td><?php echo __('admin_php_built_on'); ?></td>
            <td><?php echo php_uname(); ?></td>
        </tr>
        <tr>
            <td><?php echo __('admin_web_server'); ?></td>
            <td><?php echo (isset($_SERVER['SERVER_SOFTWARE'])) ? $_SERVER['SERVER_SOFTWARE'] : @getenv('SERVER_SOFTWARE'); ?></td>
        </tr>
        <tr>
            <td><?php echo __('admin_web_server_php_interface'); ?></td>
            <td><?php echo php_sapi_name(); ?></td>
        </tr>
        <?php
            if (function_exists('apache_get_modules')) {
                if ( ! in_array('mod_rewrite',apache_get_modules())) {
                    echo '<tr><td>'.'Apache Mod Rewrite'.'</td><td>'.__('admin_not_installed').'</td></tr>';
                } else {
                    echo '<tr><td>'.'Apache Mod Rewrite'.'</td><td>'.__('admin_installed').'</td></tr>';
                }
            } else {
                echo '<tr><td>'.'Apache Mod Rewrite'.'</td><td>'.__('admin_installed').'</td></tr>';
            }
        ?>
    </tbody>
</table>
<br>
<br>


<?php if (Filesystem::isFileWritable(ROOT_DIR . '/.htaccess') or
          Filesystem::isFileWritable(ROOT_DIR . '/index.php') or
          Registry::get('system.errors.display') === true) { ?>

        <h3 class="h3"><?php echo  __('admin_security_check_results'); ?></h3>

        <table class="table no-margin">
            <tbody>
                <?php if (Filesystem::isFileWritable(ROOT_DIR . '/.htaccess')) { ?>
                <tr>
                    <td><?php echo __('admin_security_check_results_htaccess', null, [':path' => ROOT_DIR . '/.htaccess']); ?></td>
                </tr>
                <?php } ?>
                <?php if (Filesystem::isFileWritable(ROOT_DIR . '/index.php')) { ?>
                <tr>
                    <td><?php echo __('admin_security_check_results_index', null, [':path' => ROOT_DIR . '/index.php']); ?></td>
                </tr>
                <?php } ?>
                <?php if (Registry::get('system.errors.display') === true) { ?>
                <tr>
                    <td><?php echo __('admin_security_check_results_debug'); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <br><br>


<?php } ?>


<?php
    Themes::view('admin/views/partials/content-end')->display();
    Themes::view('admin/views/partials/footer')->display();
?>