<?php
namespace Flextype;
use Flextype\Component\{Registry\Registry, Html\Html, Form\Form, Http\Http, Token\Token};
use function Flextype\Component\I18n\__;
?>

<?php
    Themes::view('admin/views/partials/head')->display();
    Themes::view('admin/views/partials/navbar')
        ->assign('links', [
                                'edit_entry'           => [
                                                            'link'       => Http::getBaseUrl() . '/admin/entries/edit?entry=' . $entry_name,
                                                            'title'      => __('admin_entries_editor'),
                                                            'attributes' => ['class' => 'navbar-item']
                                                         ],
                                'edit_entry_media'     => [
                                                            'link'       => Http::getBaseUrl() . '/admin/entries/edit?entry=' . $entry_name . '&media=true',
                                                            'title'      => __('admin_entries_edit_media'),
                                                            'attributes' => ['class' => 'navbar-item']
                                                        ],
                                  'edit_entry_fieldset'       => [
                                                              'link'       => Http::getBaseUrl() . '/admin/entries/edit?entry=' . $entry_name . '&fieldset=true',
                                                              'title'      => __('admin_entries_editor_fieldset'),
                                                              'attributes' => ['class' => 'navbar-item active']
                                                           ],
                                   'edit_entry_template'       => [
                                                               'link'       => Http::getBaseUrl() . '/admin/entries/edit?entry=' . $entry_name . '&template=true',
                                                               'title'      => __('admin_entries_editor_template'),
                                                               'attributes' => ['class' => 'navbar-item']
                                                            ],
                                    'edit_entry_source'           => [
                                                                'link'       => Http::getBaseUrl() . '/admin/entries/edit?entry=' . $entry_name . '&source=true',
                                                                'title'      => __('admin_entries_editor_source'),
                                                                'attributes' => ['class' => 'navbar-item']
                                                             ]
                            ])
        ->assign('buttons', [
                                'save' => [
                                                    'link'       => 'javascript:;',
                                                    'title'      => __('admin_save'),
                                                    'attributes' => ['class' => 'js-save-form-submit float-right btn']
                                                ]
                            ])
        ->assign('entry', $entry)
        ->display();
    Themes::view('admin/views/partials/content-start')->display();
?>

<?php echo Form::open(null, ['id' => 'form']); ?>
<?php echo Form::hidden('token', Token::generate()); ?>
<?php echo Form::hidden('action', 'save-form'); ?>
<?php echo Form::hidden('entry_name', $entry_name); ?>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label><?php echo __('admin_entries_fieldset_for_template'); ?>: <code><?php echo $entry['template']; ?></code></label>
            <?php
                echo (
                    Form::textarea('fieldset', $fieldset, ['class' => 'form-control', 'style' => 'min-height:500px;', 'id' => 'codeMirrorEditor'])
                );
            ?>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php
    Themes::view('admin/views/partials/content-end')->display();
    Themes::view('admin/views/partials/footer')->display();
?>
