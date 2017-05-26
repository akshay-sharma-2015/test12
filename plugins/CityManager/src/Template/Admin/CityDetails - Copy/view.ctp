<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit City Detail'), ['action' => 'edit', $cityDetail->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete City Detail'), ['action' => 'delete', $cityDetail->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cityDetail->id)]) ?> </li>
        <li><?= $this->Html->link(__('List City Details'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City Detail'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cityDetails view large-9 medium-8 columns content">
    <h3><?= h($cityDetail->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('City') ?></th>
            <td><?= $cityDetail->has('city') ? $this->Html->link($cityDetail->city->name, ['controller' => 'Cities', 'action' => 'view', $cityDetail->city->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($cityDetail->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Slug') ?></th>
            <td><?= h($cityDetail->slug) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($cityDetail->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Object Id') ?></th>
            <td><?= $this->Number->format($cityDetail->object_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($cityDetail->created) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($cityDetail->description)); ?>
    </div>
</div>
