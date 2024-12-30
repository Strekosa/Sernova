<?php
/**
 * Block Name: Table
 * Description: Table block managed with ACF.
 * Category: common
 * Icon: list-view
 * Keywords: table acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package sernova
 *
 * @var array $block
 */

$slug = str_replace('acf/', '', $block['name']);
$block_id = $slug . '-' . $block['id'];
$align_class = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset($block['className']) ? $block['className'] : '';

$table = get_field('table');
?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"

>
	<div class="<?php echo $slug; ?>__wrapp container-boxed">

		<?php

		if (!empty ($table)) {

			echo '<table id="price-list">';

			if (!empty($table['caption'])) {

				echo '<caption>' . $table['caption'] . '</caption>';
			}

			if (!empty($table['header'])) {
				echo '<thead class="thead">';
				echo '<tr>';

				foreach ($table['header'] as $index => $th) {
					echo '<th data-index="' . $index . '">';
					echo $th['c'];
					echo '</th>';
				}

				echo '</tr>';
				echo '</thead>';
			}

			echo '<tbody>';

			foreach ($table['body'] as $tr) {

				echo '<tr>';

				foreach ($tr as $td) {

					echo '<td>';
					echo $td['c'];
					echo '</td>';
				}

				echo '</tr>';
			}

			echo '</tbody>';

			echo '</table>';
		} ?>
	</div>
</section>
