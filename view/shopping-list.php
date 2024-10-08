<?php include ('./view/components/header.php') ?>
<section class="section-margin">
	<div class="container mx-auto">
		<div class="panel">
			<div class="spending-limit mb-5">
				<h2 class="header">Spending Limit = £<span id="spendingLimit"><?= $user['spending_limit']; ?></span><span class="spending-limit__message">You have reached your spending limit</span></h2>
				<form method="post">
					<input type="hidden" name="action" value="set_user_spending_limit" />
					<input type="hidden" name="user_id" value='<?= $user_id; ?>' />
					<div class="form__input">
						<input type="text" name="spending_limit" value="" placeholder="Set Spending Limit" />
					</div>
					<button class="btn--add" type="submit">Set Limit</button>
				</form>
			</div>
			<div class="panel__row grid grid-cols-12 gap-8">
				<div class="panel__column md:col-span-6 col-span-12">
					<h2 class="header mb-5">List Items</h2>
					<?php $price_array = array(); ?>
					<?php if(isset($user_products) && count($user_products) > 0) { ?>
						<?php foreach($user_products as $product) { ?>
							<div class="panel__item selected-product" data-product-id='<?= $product['id']; ?>'>
								<div class="left">
									<span class="font-semibold"><?= $product['name']; ?></span>

									<form method="post">
										<input type="hidden" name="action" value="order_products" />
										<input type="hidden" name="user_id" value='<?= $product['user_id'] ?>' />
										<input type="hidden" name="product_id" value='<?= $product['id'] ?>' />
									</form>
								</div>
								<div class="right">
									<span class="btn--purchase" data-value='<?= $product['id']; ?>'>Pick Up</span>
									<form method="post">
										<input type="hidden" name="action" value="remove_product" />
										<input type="hidden" name="user_id" value='<?= $product['user_id'] ?>' />
										<input type="hidden" name="product_id" value='<?= $product['id'] ?>' />
										<button onclick="removeProductFromStoredArray('<?= $product['id']; ?>')" class="btn--remove" type="submit">Remove</button>
									</form>
								</div>
							</div>
							<?php $price_array[] = $product['price']; ?>
						<? } ?>
					<? } else { ?>
						<h4 class="header header--extra-small">No products in basket</h4>
					<? } ?>
				</div>
				<div class="panel__column md:col-span-6 col-span-12">
					<h2 class="header mb-5">Products for Sale</h2>
					<?php if(isset($all_products)) { ?>
						<?php foreach($all_products as $product) { ?>
							<div class="panel__item">
								<div class="left">
									<span class="font-semibold"><?= $product['name']; ?></span> - <span class="font-semibold">£<?= $product['price']; ?></span>
								</div>
								<div class="right">
									<form method="post" class="product-add-form-<?= $product['id'] ?>">
										<input type="hidden" name="action" value="add_product" />
										<input type="hidden" name="product_id" value='<?= $product['id']; ?>' />
										<input type="hidden" name="user_id" value='<?= $user_id; ?>' />
										<button class="btn--add" type="submit">Add</button>
									</form>
								</div>
							</div>
						<? } ?>
					<? } ?>
				</div>
			</div>
		</div>
		<div class="panel panel--slim section-margin">
			<?php $total = array_sum($price_array); ?>
			<div class="panel__total">
				<h4 class="header header--small">Total: £<span id="basketTotal"><?= $total; ?></span></h4>
			</div>
		</div>
	</div>
</section>
<script src="resources/js/app.js"></script>

<?php include ('./view/components/footer.php') ?>