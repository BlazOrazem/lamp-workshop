<?php if(!defined('ALLOW_INCLUDE')) die('Forbidden!'); ?>

<form method="POST" action="/admin/update/<?=$workshop['id']?>">
    <input type="hidden" name="posted" value="1">

    <div class="form-group">
        <label for="title">Naziv delavnice</label>
        <input type="text" name="title" value="<?=$workshop['title']?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="date">Datum in ura delavnice</label>
        <input type="text" name="date" value="<?=date('d.m.Y H:i:s', strtotime($workshop['start_date']))?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="capacity">Max. število prijav (neobvezno)</label>
        <input type="text" name="capacity" value="<?=$workshop['capacity']?>" class="form-control">
    </div>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endif; ?>
    <button type="submit" class="btn btn-success">Uredi delavnico</button>
</form>
