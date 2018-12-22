<?php
namespace Flextype;
use Flextype\Component\{Registry\Registry, Http\Http, Form\Form, Token\Token};
use function Flextype\Component\I18n\__;
?>

<?php
    Themes::view('admin/views/partials/head')->display();
    Themes::view('admin/views/partials/navbar')
        ->assign('links', [
                                'entries'     => [
                                                    'link'  => Http::getBaseUrl() . '/admin/entries',
                                                    'title' => __('admin_entries_heading'),
                                                    'attributes' => ['class' => 'navbar-item']
                                                ],
                                'entries_move' => [
                                                    'link' => Http::getBaseUrl() . '/admin/entries/move',
                                                    'title' => __('admin_entries_move'),
                                                    'attributes' => ['class' => 'navbar-item active']
                                                ]
                         ])
        ->assign('entry', $entry)
        ->display();
    Themes::view('admin/views/partials/content-start')->display();
?>

<div class="row">
    <div class="col-md-6">

        <?php echo Form::open(); ?>
        <?php echo Form::hidden('token', Token::generate()); ?>
        <?php echo Form::hidden('entry_path_current', $entry_path_current); ?>
        <?php echo Form::hidden('entry_parent_current', $entry_parent); ?>
        <?php echo Form::hidden('name_current', $name_current); ?>

        <div class="form-group">
           <?php
               echo (
                   Form::label('parent_entry', __('admin_entries_parent_entry')).
                   Form::select('parent_entry', $entries_list, $entry_parent, array('class' => 'form-control'))
               );
           ?>
         </div>

         <?php echo Form::submit('move_entry', __('admin_save'), ['class' => 'btn btn-black btn-fill btn-wd']); ?>
     <?php echo Form::close(); ?>

 </div>
</div>

<?php
    Themes::view('admin/views/partials/content-end')->display();
    Themes::view('admin/views/partials/footer')->display();
?>