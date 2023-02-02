<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="index.html">
				<span><i class="fa fa-gg"></i></span>
				<span>Stok Yönetim Sistemi</span>
			</a>
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
	<h4 class="form-title m-b-xl text-center">Stok Yönetim Giriş Ekranı</h4>
	<form action="<?php echo base_url('userop/do_login'); ?>" method="POST">
		<div class="form-group"> 
			<input id="sign-in-email" type="email" class="form-control" placeholder="E-posta" name="user_email" value="<?php echo $this->input->post('user_email'); ?>">
			<?php if(isset($form_error)) { ?>
				<small class="input-form-error"><?php echo form_error('user_email'); ?></small>
			<?php } ?>
		</div>

		<div class="form-group">
			<input id="sign-in-password" type="password" class="form-control" placeholder="Şifre" name="user_password" value="<?php echo $this->input->post('user_password'); ?>">
			<?php if(isset($form_error)) { ?>
				<small class="input-form-error"><?php echo form_error('user_password'); ?></small>
			<?php } ?>
		</div>
		<button type="submit" class="btn btn-primary">Giriş Yap</button>
	</form>
</div><!-- #login-form -->

<div class="simple-page-footer">
	<p><a href="password-forget.html">Şifreni mi unuttun ?</a></p>
</div><!-- .simple-page-footer -->


	</div>