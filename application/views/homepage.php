<div>
	<?php if($user_email): ?>
		<h2>Hello <em><?php echo $user_email; ?></em>.</h2>
		<h2><?= anchor('logout', 'Logout'); ?></h2>
	<?php else: ?>
		<h2>New Users: <?= anchor('signup', 'Create an Account'); ?>.</h2>
		<h2>Members: <?= anchor('login', 'Login'); ?>.</h2>
	<?php endif; ?>
</div>