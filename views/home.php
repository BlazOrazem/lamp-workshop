<?php if(!defined('ALLOW_INCLUDE')) die('Forbidden!'); ?>

<?php if(!empty($success)): ?>

	<div class="alert alert-warning">
        <p>Vaša prijava je bila zabeležena.</p>
        <p>Hvala za sodelovanje!</p>
    </div>
	<a href="/" class="btn btn-primary btn-sm">&laquo; Nazaj na prijavnico</a>
	
<?php else: ?>

	<?php if(!empty($workshops)): ?>

		<form role="form" method="POST">
			<input type="hidden" name="posted" value="1">
			<div class="form-group">
				<label for="workshop">Izberite delavnico</label>
				<select name="workshop" class="form-control">
					<option value="">---</option>
					<?php foreach($workshops as $workshop): ?>
						<option value="<?=$workshop['id']?>">
							<?=$workshop['title']?> (<?=date('d.m.Y H:i',strtotime($workshop['start_date']))?>)
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="ful_name">Ime in priimek</label>
				<input type="text" name="full_name" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">E-mail naslov</label>
				<input type="email" name="email" class="form-control">
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="confirm" value="1">
					Potrjujem, da so zgoraj navedeni podatki pravi.
				</label>
			</div>
			<?php if(!empty($error)): ?>
				<div class="alert alert-danger"><?=$error?></div>
			<?php endif; ?>
			<button type="submit" class="btn btn-info btn-warning"><strong>Pošlji prijavo</strong></button>
		</form>

	<?php else: ?>

		<div class="alert alert-danger">Trenutno ni odprtih prijav za nobeno delavnico.</div>

	<?php endif; ?>

<?php endif; ?>
