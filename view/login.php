<?php include ('./view/components/header.php') ?>
<section class="section-margin">
	<div class="container container--slim">
		<div class="panel">
			<div class="panel__row panel__row--50">
				<div class="panel__column ">
					<h2>Login</h2>
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
</section>

<?php include ('./view/components/footer.php') ?>