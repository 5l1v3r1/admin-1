<?php
namespace Flextype;
use Flextype\Component\{Registry\Registry, Http\Http, Form\Form, Html\Html, Token\Token};
use function Flextype\Component\I18n\__;
?>

<?php
    Themes::view('admin/views/partials/head')->display();
    Themes::view('admin/views/partials/navbar')
        ->assign('links', [
                            'pages' => [
                                            'link' => Http::getBaseUrl() . '/admin/pages',
                                            'title' => __('admin_pages_heading'),
                                            'attributes' => ['class' => 'navbar-item']
                                        ],
                           'pages_add' => [
                                            'link' => Http::getBaseUrl() . '/admin/pages/add',
                                            'title' => __('admin_pages_create_new'),
                                            'attributes' => ['class' => 'navbar-item active']
                                          ]
                          ])
        ->display();
    Themes::view('admin/views/partials/content-start')->display();
?>

<div class="row">
    <div class="col-md-6">
        <?php echo Form::open(); ?>
        <?php echo Form::hidden('token', Token::generate()); ?>
        <div class="form-group">
            <?php
                echo (
                    Form::label('title', __('admin_pages_title'), ['for' => 'pageTitle']).
                    Form::input('title', '', ['class' => 'form-control', 'id' => 'pageTitle', 'required', 'data-validation' => 'length alphanumeric', 'data-validation-length' => '1-255', 'data-validation-error-msg' => __('admin_pages_error_title_empty_input')])
                );
            ?>
        </div>
        <div class="form-group">
            <?php
                echo (
                    Form::label('slug', __('admin_pages_name'), ['for' => 'pageSlug']).
                    Form::input('slug', '', ['class' => 'form-control', 'id' => 'pageSlug', 'required', 'required', 'data-validation' => 'length alphanumeric', 'data-validation-length' => '1-255', 'data-validation-error-msg' => __('admin_pages_error_name_empty_input')])
                );
            ?>
        </div>
        <div class="form-group">
            <label for="formGroupParentPageInput"><?php echo __('admin_pages_parent_page'); ?></label>
            <select class="form-control" id="formGroupParentPageInput" name="parent_page">
            <option value="">/</option>
            <?php foreach($pages_list as $page) { ?>
            <option value="<?php if ($page['slug'] != '') echo $page['slug']; else echo Registry::get('system.pages.main'); ?>"><?php if ($page['slug'] != '') echo $page['slug']; else echo Registry::get('system.pages.main'); ?></option>
            <?php } ?>
            </select>
        </div>
    </div>
</div>

<?php echo Form::submit('create_page', __('admin_create'), ['class' => 'btn btn-black']); ?>
<?php echo Form::close(); ?>

<?php
    Themes::view('admin/views/partials/content-end')->display();
    Themes::view('admin/views/partials/footer')->display();
?>
