		</div>

		<div id="footer"></div>

		<?php
			if (isset($scripts) && is_array($scripts)) {
				foreach ($scripts as $source) { ?>
					<script src="<?php echo $source; ?>"></script>
				<?php }
			}
		?>

		<div id="orbital" class="spinner"></div>
		<div id="orbital2" class="spinner"></div>
	</body>
</html>