<?php include ('./view/components/header.php') ?>
<section class="section-margin">
	<div class="container mx-auto container--slim">
		<? if(isset($_GET['msg'])) { 
			$msg = $_GET['msg'];
			if($msg == 'fail-1') { 
				$message = 'Please Complete All Fields';
			} else if($msg == 'fail-2') {
				$message = 'Passwords Must Match';
			} else if ($msg == 'login-fail') {
				$message = 'Incorrect details';
			} else if ($msg == 'success') {
				$message = 'Account Created, Please Login';
			}
		} ?>
		<?php if(isset($message)) { ?>
			<h4 class="header text-center text-red-600 mb-5 header--extra-small"><?= $message; ?></h4>
		<? } ?>
		<div class="grid grid-cols-12 gap-10">
			<div class="col-span-6">
				<div class="panel">
					<div class="panel__row">
						<div class="panel__column">
							<div id="login">
								<h2 class="header header--small">Login</h2>
								<form method="post">
									<input type="hidden" value="login" name="action" />
									<label for="email" class="form__input">
										<input id="email" name="email" type="text" placeholder="Email Address"/>
									</label>
									<label for="password" class="form__input">
										<input id="password" name="password" type="password" placeholder="Password"/>
									</label>
									<button class="btn" type="submit">Login</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-span-6">
				<div class="panel">
					<div class="panel__row">
						<div class="panel__column">
							<div id="register">
								<h2 class="header header--small">Register</h2>
								<form method="post">
									<input type="hidden" value="register" name="action" />
									<label for="email" class="form__input">
										<input id="email" name="email" type="text" placeholder="Email Address"/>
									</label>
									<label for="password" class="form__input">
										<input id="password" name="password" type="password" placeholder="Password"/>
									</label>
									<label for="password_confirm" class="form__input">
										<input id="password_confirm" name="password_confirm" type="password" placeholder="Confirm Password"/>
									</label>
									<button class="btn" type="submit">Register</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>



<?php include ('./view/components/footer.php') ?>