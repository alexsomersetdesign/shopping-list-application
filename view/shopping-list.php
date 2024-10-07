<?php include ('./view/components/header.php') ?>
<section class="section-margin">
	<div class="container">
		<div class="panel">
			<div class="panel__row">
				<div class="panel__column panel__column--50 panel__column--right-spacing">
					<div class="spending-limit">
						<h2>Spending Limit = £<span id="spendingLimit">50</span><span class="spending-limit__message">You have reached your spending limit</span></h2>
					</div>
					<h2>List Items</h2>
					<?php $price_array = array(); ?>
					<?php if(isset($user_products) && count($user_products) > 0) { ?>
						<?php foreach($user_products as $product) { ?>
							
							<div class="panel__item">
								<div class="left">
									<span><?= $product['name']; ?></span>

									<form method="post">
										<input type="hidden" name="action" value="order_products" />
										<input type="hidden" name="user_id" value='<?= $product['user_id'] ?>' />
										<input type="hidden" name="product_id" value='<?= $product['id'] ?>' />


										<!-- <select name="order">
											 set a counter which increments each time a product is looped over so number of options will match that of products, increment the counter and allow user to set an ordinal for each product 
											<?php /* $counter = 1; ?>
											<?php foreach($user_products as $product) { ?>
												<option value='<?= $counter; ?>'><?= $counter; ?></option>
												<?php $counter++; ?>
											<? } */ ?>
										</select> -->


										<!-- <button class="btn--add" type="submit">Order</button> -->
									</form>



								</div>
								<div class="right">
									<span class="btn--purchase">Purchase</span>
									<form method="post">
										<input type="hidden" name="action" value="remove_product" />
										<input type="hidden" name="user_id" value='<?= $product['user_id'] ?>' />
										<input type="hidden" name="product_id" value='<?= $product['id'] ?>' />
										<button class="btn--remove" type="submit">Remove</button>
									</form>
								</div>
							</div>
							<?php $price_array[] = $product['price']; ?>

						<? } ?>
					<? } else { ?>
						<h4>No products in basket</h4>
					<? } ?>

				</div>
				<div class="panel__column panel__column--50 panel__column--left-padding">
					<h2>Products for Sale</h2>
					<?php if(isset($all_products)) { ?>
						<?php foreach($all_products as $product) { ?>
							<div class="panel__item">
								<div class="left">
									<span><?= $product['name']; ?></span> - <span>£<?= $product['price']; ?></span>
								</div>
								<div class="right">
									<form method="post">
										<input type="hidden" name="action" value="add_product" />
										<input type="hidden" name="product_id" value='<?= $product['id'] ?>' />
										<input type="hidden" name="user_id" value='<?= $product['user_id'] ?>' />
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
				<h4>Total: £<span id="basketTotal"><?= $total; ?></span></h4>
			</div>
		</div>
	</div>
</section>
<script>
	//Cross off functionality
	const purchased_selectors = document.querySelectorAll('.btn--purchase');

	//Using the below rather than polluting the html with onlick event handlers
	purchased_selectors.forEach(selector => {
		selector.addEventListener('click', function() {

			//Get closest panel item working up the DOM tree, toggle styling and text to indicate to user if they have purchased the item or not
			const product = selector.closest('.panel__item');
			product.classList.toggle('panel__item--purchased');

			selector.classList.toggle('btn--clicked');

			if(selector.classList.contains('btn--clicked')) {
				selector.textContent = 'Un-Purchase';
			} else {
				selector.textContent = 'Purchase';
			}


		})
	})
</script>
<script>

	const spending_message = document.querySelector('.spending-limit__message');
	let spending_limit = parseInt(document.getElementById('spendingLimit').textContent);
	let basket_total = parseInt(document.getElementById('basketTotal').textContent);


	if(basket_total > spending_limit) {
		spending_message.classList.add('display');
	}


	

</script>

<?php include ('./view/components/footer.php') ?>