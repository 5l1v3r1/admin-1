<?php
namespace Flextype;
use Flextype\Component\{Registry\Registry, Http\Http, Form\Form, Token\Token};
use function Flextype\Component\I18n\__;
?>

<?php
    Themes::view('admin/views/partials/head')->display();
    Themes::view('admin/views/partials/navbar')
        ->assign('links', [
                                'pages'     => [
                                                    'link'  => Http::getBaseUrl() . '/admin/pages',
                                                    'title' => __('admin_pages_heading'),
                                                    'attributes' => ['class' => 'navbar-item']
                                                ],
                                'pages_add' => [
                                                    'link' => Http::getBaseUrl() . '/admin/pages/rename',
                                                    'title' => __('admin_pages_rename'),
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
        <?php echo Form::hidden('page_path_current', $page_path_current); ?>
        <?php echo Form::hidden('page_parent', $page_parent); ?>
        <?php echo Form::hidden('name_current', $name_current); ?>


        <div class="form-group">
            <?php
                echo (
                    Form::label('name', __('admin_pages_name'), ['for' => 'pageName']).
                    Form::input('name', $name_current, ['class' => 'form-control', 'id' => 'pageName', 'required', 'data-validation' => 'length alphanumeric', 'data-validation-length' => '1-255', 'data-validation-error-msg' => __('admin_pages_error_name_empty_input')])
                );
            ?>
        </div>

         <?php echo Form::submit('rename_page', __('admin_save'), ['class' => 'btn btn-black btn-fill btn-wd']); ?>
     <?php echo Form::close(); ?>

 </div>
</div>

<?php
    Themes::view('admin/views/partials/content-end')->display();
    Themes::view('admin/views/partials/footer')->display();
?>
