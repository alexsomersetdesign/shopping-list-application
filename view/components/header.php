<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shopping List Application</title>
	<link rel="stylesheet" href="resources/css/app.css" />
	<link rel="stylesheet" href="resources/css/tailwind-output.css" />
</head>
<body>
	<main class="main">
		<header>
			<div class="container mx-auto pt-5 pb-5">
				<div class="grid grid-cols-12 items-center">
					<div class="md:col-span-6 col-span-12">
						<h1 class="header__title">Shopping List Application</h1>
					</div>
					<div class="md:col-span-6 text-end col-span-12">
						<? if(isset($_GET['user'])) { ?>
							<a href="/" class="btn--white">Logout</a>
						<? } ?>
					</div>
				</div>
			</div>
		</header>