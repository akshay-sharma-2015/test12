<!-- src/Template/Users/add.ctp -->

<div class="users form">
<?= $this->Form->create($user,array('novalidate' => false)) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->input('username',array('required' => false)) ?>
        <?= $this->Form->input('password',array('required' => false)) ?>
        
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>