		</div>

		<div id="footer"></div>

		<?php
			if (isset($scripts) && is_array($scripts)) {
				foreach ($scripts as $source) { ?>
					<script src="<?php echo $source; ?>"></script>
				<?php }
			}
		?>
	</body>
</html>