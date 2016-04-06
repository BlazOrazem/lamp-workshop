<?php if(!defined('ALLOW_INCLUDE')) die('Forbidden!'); ?>

<form method="POST" action="/admin/create">
    <input type="hidden" name="posted" value="1">

    <div class="form-group">
        <label for="title">Naziv delavnice</label>
        <input type="text" name="title" value="<?php if (isset($postTitle)) echo($postTitle); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="date">Datum in ura delavnice</label>
        <input type="text" name="date" value="<?php if (isset($postDate)) echo($postDate); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="capacity">Max. število prijav (neobvezno)</label>
        <input type="text" name="capacity" class="form-control">
    </div>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endif; ?>
    <button type="submit" class="btn btn-success">Dodaj delavnico</button>
</form>
