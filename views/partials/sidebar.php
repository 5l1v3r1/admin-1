<?php
namespace Flextype;
use Flextype\Component\{Http\Http, Html\Html, Registry\Registry, Arr\Arr, Event\Event, Token\Token, Session\Session};
use function Flextype\Component\I18n\__;
use Flextype\Navigation;
?>
<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="flextype-logo">
            <a href="<?php echo Http::getBaseUrl(); ?>/admin">
                FLEXTYPE
            </a>
            <a href="<?php echo Http::getBaseUrl(); ?>" class="view-site-link" target="_blank">
                <i class="fas fa-external-link-alt"></i>
            </a>
        </div>
          <ul class="nav">
            <?php
                $active_menu_item = Registry::exists('sidebar_menu_item') ? Registry::get('sidebar_menu_item') : '';
            ?>
            <?php foreach (NavigationManager::getItems('content') as $item) { ?>
                <li class="nav-item <?php echo ($item['item'] == $active_menu_item) ? 'active' : ''; ?>">
                    <?php echo Html::anchor($item['title'], $item['link'], $item['attributes']); ?>
                </li>
            <?php } ?>
            <?php foreach (NavigationManager::getItems('extends') as $item) { ?>
                <li class="nav-item <?php echo ($item['item'] == $active_menu_item) ? 'active' : ''; ?>">
                    <?php echo Html::anchor($item['title'], $item['link'], $item['attributes']); ?>
                </li>
            <?php } ?>
            <?php foreach (NavigationManager::getItems('settings') as $item) { ?>
                <li class="nav-item <?php echo ($item['item'] == $active_menu_item) ? 'active' : ''; ?>">
                    <?php echo Html::anchor($item['title'], $item['link'], $item['attributes']); ?>
                </li>
            <?php } ?>
            <?php foreach (NavigationManager::getItems('help') as $item) { ?>
                <li class="nav-item <?php echo ($item['item'] == $active_menu_item) ? 'active' : ''; ?>">
                    <?php echo Html::anchor($item['title'], $item['link'], $item['attributes']); ?>
                </li>
            <?php } ?>
        </ul>
        <div class="flextype-user">
              <ul class="nav">
                  <li class="nav-item <?php echo ('profile' == $active_menu_item) ? 'active' : ''; ?>">
                      <a class="nav-link" href="<?php echo Http::getBaseUrl();?>/admin/profile">
                          <i class="fas fa-user-circle"></i>
                          <p>
                              <?php echo Session::get('username'); ?>
                          </p>
                      </a>
                  </li>
              </ul>
        </div>
    </div>
</div>
<div class="sidebar-off-canvas"></div>
