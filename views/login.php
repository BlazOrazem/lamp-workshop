<?php if(!defined('ALLOW_INCLUDE')) die('Forbidden!'); ?>

<form method="POST" action="/admin/login">
    <input type="hidden" name="posted" value="1">

    <div class="form-group">
        <label for="username">Uporabniško ime</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Vaše geslo</label>
        <input type="password" name="password" class="form-control">
    </div>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary">Prijava v administracijo</button>
    <a href="/" class="btn btn-success pull-right">Na spletno stran</a>
</form>
