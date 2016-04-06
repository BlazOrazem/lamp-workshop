<?php if(!defined('ALLOW_INCLUDE')) die('Forbidden!'); ?>

<?php if (!empty($workshops)): ?>

    <ul class="list-group">
        <?php foreach ($workshops as $workshop): ?>
            <?php $date = strtotime($workshop['start_date']); ?>
            <?php $past = $date < time(); ?>
            <li class="list-group-item<?php if ($past): ?> list-group-item-warning<?php endif; ?>">
                <?php if (!empty($workshop['applications'])): ?>
                    <span class="badge"><?=$workshop['applications']?> prijav</span>
                <?php else: ?>
                    <span class="badge">Ni prijav</span>
                <?php endif; ?>
                <h4 class="list-group-item-heading">
                    <a href="/admin/edit/<?=$workshop['id']?>">
                        <?=$workshop['title']?>
                    </a>
                </h4>

                <p class="list-group-item-text">
                    <strong><?=date('d.m.Y H:i', $date)?></strong>
                    <?php if ($workshop['capacity']): ?>
                        (Max <?=$workshop['capacity']?> prijav)
                    <?php else: ?>
                        (Ni omejitve)
                    <?php endif; ?>
                </p>
            </li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>

    <div class="alert alert-warning">Ni razpisanih delavnic.</div>

<?php endif; ?>
