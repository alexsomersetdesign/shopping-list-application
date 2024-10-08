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
				<div class="panel__column col-span-6">
					<h2 class="header mb-5">List Items</h2>
					<?php $price_array = array(); ?>
					<?php if(isset($user_products) && count($user_products) > 0) { ?>
						<?php foreach($user_products as $product) { ?>
							<div class="panel__item selected-product" data-product-id='<?= $product['id']; ?>'>
								<div class="left">
									<span><?= $product['name']; ?></span>

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
				<div class="panel__column col-span-6">
					<h2 class="header mb-5">Products for Sale</h2>
					<?php if(isset($all_products)) { ?>
						<?php foreach($all_products as $product) { ?>
							<div class="panel__item">
								<div class="left">
									<span><?= $product['name']; ?></span> - <span>£<?= $product['price']; ?></span>
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
<script>

	const pick_up_selectors = document.querySelectorAll('.btn--purchase');
	const remove_selectors = document.querySelectorAll('.btn--remove');
	const selected_products = document.querySelectorAll('.selected-product');
	const storedItems = sessionStorage.getItem('stored-items');
	//Spending message logic
	const spending_message = document.querySelector('.spending-limit__message');
	const spending_limit = parseInt(document.getElementById('spendingLimit').textContent);
	const basket_total = parseInt(document.getElementById('basketTotal').textContent);

	//Check to see if the spending limit is matched or exceeded
	if(basket_total >= spending_limit) {
		spending_message.classList.add('display');
	}

	//Checks for stored items, if true, process the items and update the UI
 	if(storedItems !== null) {
   		getStoredItems();
	}

	//Ensures session storage is cleared if there are no products within selected list
	if(!selected_products.length) {
		sessionStorage.removeItem('stored-items');
	}

	//Add event listeners to the buttons to add products to array in local storage allowing 'crossed off' to persist on page reloads
	pick_up_selectors.forEach(selector => {
		selector.addEventListener('click', function() {
			if(storedItems !== null) {
	            const storedItemArray = storedItems.split(",");
	            //Check to see if the product id already exists, if so, do not add again
	            if(storedItemArray.includes(selector.dataset.value)) {
	            	return;
	            } else {
	            	storedItemArray.push(selector.dataset.value);
	            	sessionStorage.setItem('stored-items', storedItemArray);
	            }

	        } else {
	            sessionStorage.setItem('stored-items', selector.dataset.value);
	        }
	        window.location.reload();
		})
	})

	//Loop over selected products and prevent user from adding the same item multiple times to the list
	selected_products.forEach(product => {
		const data = product.dataset.productId;
		const forms = document.querySelectorAll(`.product-add-form-${data}`);
		forms.forEach(form => {
			const btn = form.querySelector('BUTTON');
			btn.disabled = true;
			btn.textContent = 'Added';
		})
	})

	//Get stored items from storage, loop over and locate instances the product is in the basket, add classlist
	function getStoredItems() {
        if(sessionStorage.getItem('stored-items')) {
            //Get items from local storage, create array and ensure any empty values are removed
            const product_array = sessionStorage.getItem('stored-items').split(",").filter(elm => elm);

            //Check array for length, find elements and style, amend text
            if(product_array.length) {
                product_array.forEach(item => {

                    const product = document.querySelector(`[data-product-id='${item}']`);
                    product.classList.add('added');

                	//Add class and styles to indicate to user, it has been added
                	product.classList.add('added');
                	const btn = product.querySelector('.btn--purchase');
	    			const product_name = product.querySelector('.left SPAN');

	    			product_name.classList.add('picked-up');
	    			btn.textContent = 'Put Back';

	    			//Add a new class which will serve as a selector to remove the product from stored array on toggle
	    			btn.classList.add('btn--return');

	    			const return_selectors = document.querySelectorAll('.btn--return');
	    			if(return_selectors) {
	    				return_selectors.forEach(item => {
					    	const product_id = item.dataset.value;
					    	item.addEventListener('click', function() {
					    		removeProductFromStoredArray(product_id);
					    		window.location.reload();
					    	});
					    })
	    			}
                    
                })
            }
        }
    }

    //Remove product from storage when removed from basket
    function removeProductFromStoredArray(id) {
    	const stored_items = sessionStorage.getItem('stored-items').split(",");

        //Loop over array and look for selected variant id then remove it
        const product = stored_items.indexOf(`${id}`);
        if(product > -1) {
            stored_items.splice(product, 1);
        }
        //Re assign session storage using new array
        sessionStorage.setItem('stored-items', stored_items);
    }

    //
 
</script>
<script>

	

</script>

<?php include ('./view/components/footer.php') ?>