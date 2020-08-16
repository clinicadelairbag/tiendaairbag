<?php

/**
 * ---------------menu--------------------------------
 */
class ajzaa_top_bar_walker extends Walker_Nav_Menu {
	static protected $ajzaa_menu_bg_test;

	function start_el (&$output, $item, $depth = 0, $args = Array (), $id = 0) {

		if (is_object ($args)) {
			$ajzaa_class = '';
			//$icon=$item->classes[1];
			self::$ajzaa_menu_bg_test = $item->mega_menu_bg_image;
			$ajzaa_icon = $item->mega_menu_icon;
			if ($item->mega_menu == 1) {
				$ajzaa_class = 'ajzaa_mega-menu';
			}
			$indent = ($depth) ? str_repeat ("\t", $depth) : '';
			$class_names = $value = '';

			$classes = empty($item->classes) ? array () : (array)$item->classes;
			$classes[] = ($item->current) ? 'active' : '';
			$classes[] = ($args->has_children) ? 'color-1 has-dropdown not-click' : '';
			$args->link_before = (in_array ('section', $classes)) ? '<label>' : '';
			$args->link_after = (in_array ('section', $classes)) ? '</label>' : '';
			$output .= (in_array ('section', $classes));
			$class_names = ($args->has_children) ? 'has-dropdown not-click ' . $ajzaa_class : '';
			$parent = $item->menu_item_parent;

			$class_names = strlen (trim ($class_names)) > 0 ? ' class="' . esc_attr ($class_names) . '"' : '';
			$output .= $indent . '
			<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

			$attributes = !empty($item->attr_title) ? ' title="' . esc_attr ($item->attr_title) . '"' : '';
			$attributes .= !empty($item->target) ? ' target="' . esc_attr ($item->target) . '"' : '';
			$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr ($item->xfn) . '"' : '';
			$attributes .= !empty($item->url) ? ' href="' . esc_attr ($item->url) . '"' : '';

			$attributes .= ' class="has-icon" ';

			$item_output = $args->before;
			$item_output .= (!in_array ('section', $classes)) ? '
			<a' . $attributes . '>' : '';
			if (($ajzaa_icon != '') and ($ajzaa_icon != '---- None ----')) {

				$item_output .= '<i class="' . $ajzaa_icon . ' fa"></i> ';
			}
			/*$item_output .= '<i class="'.$icon.' fa"></i> ';*/
			$item_output .= $args->link_before . apply_filters ('the_title', $item->title, $item->ID);
			$item_output .= $args->link_after;
			$item_output .= (!in_array ('section', $classes)) ? '</a>' : '';
			$item_output .= $args->after;

			$output .= apply_filters ('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		}
	}

	function end_el (&$output, $item, $depth = 0, $args = Array ()) {
		$output .= '
</li>' . "\n";
	}

	function start_lvl (&$output, $depth = 0, $args = Array ()) {
		$indent = str_repeat ("\t", $depth);
		if (self::$ajzaa_menu_bg_test != '') {
			$output .= "\n" . $indent . '
		
		<ul class="sub-menu dropdown " style = "background : rgba(0,0,0,0.8) url(' . self::$ajzaa_menu_bg_test . '); background-size : cover;">
			' . "\n";
		}
		else {
			$output .= "\n" . $indent . '
		
		<ul class="sub-menu dropdown ">
			' . "\n";
		}
	}

	function end_lvl (&$output, $depth = 0, $args = Array ()) {
		$indent = str_repeat ("\t", $depth);
		$output .= $indent . '
</ul>' . "\n";
	}

	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$id_field = $this->db_fields['id'];
		if (is_object ($args[0])) {
			$args[0]->has_children = !empty($children_elements[$element->$id_field]);
		}

		return parent::display_element ($element, $children_elements, $max_depth, $depth, $args, $output);
	}

}


function ajzaa_main_menu_fallback () {
	echo '<div class="empty-menu">';
	echo esc_html__ ('Please assign a menu to the primary menu location under ', 'ajzaa'); ?>
	<a href="<?php echo admin_url ('nav-menus.php') ?>"><?php echo esc_html__('Menus Settings','ajzaa') ?></a>
	</div> <?php
}

function ajzaa_category_menu_fallback () {
	?>
	<div class="menu-testing-menu-container">
    <ul id="drop" class="category-menu  f-open-dropdown" aria-hidden="false">
      <li>
        <?php
        echo '<div class="empty-menu">'; ?>
	      <a href="<?php echo admin_url ('nav-menus.php') ?>"><?php echo esc_html__('Menus Settings','ajzaa') ?></a>
	      <?php echo '</div>'; ?>
      </li>
    </ul>
  </div>
	<?php

}