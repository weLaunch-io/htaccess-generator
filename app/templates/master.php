<? include('head.php'); ?>
<? include('header.php'); ?>

		<main id="main" class="main row">
			<? include('message.php'); ?>

			<aside id="sidebar" class="sidebar col-sm-3 col-lg-2">
				<? include('sidebar.php'); ?>
			</aside>
			<section id="content" class="content col-sm-9 col-lg-10">
				<? include($child); ?>
			</section>
		</main>

<? include('footer.php'); ?>