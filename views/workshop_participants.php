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
                <hr>
                <?php if (!$workshop['participants']): ?>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Ni prijav.</h3>
                        </div>
                    </div>
                <?php endif; ?>
                <?php foreach ($workshop['participants'] as $participant): ?>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?=$participant['full_name']?></h3>
                        </div>
                        <div class="panel-body">
                            <p>E-mail: <a href="mailto:<?=$participant['email']?>"><?=$participant['email']?></a>
                            </p>

                            <p>Prijavil dne: <?=date('d.m.Y', strtotime($participant['date_added']))?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php else: ?>

    <div class="alert alert-warning">Ni delavnic.</div>

<?php endif; ?>
