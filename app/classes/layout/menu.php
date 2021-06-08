<?php

	class Layout_Menu{
		/*
			Layout_Menu::do_menu($curr_page)
			@desc Creates main nav.
			@param $curr_page (int)
			@return <nav>...</nav> [string]
		*/
		public static function do_menu($curr_page){
			$color = '';
			$n = '<a class="navbar-item" href="' . Uri::base(false) . '"> name </a>';
			// Get menu color
			switch($curr_page){
				case 1:
					$color = 'link';
					break;
				case 2:
					$color = 'info';
					break;
				case 3:
				default:
					$color = 'dark';
					break;
			}
			$d = View::forge('components/menu');
			$d->color = $color;
			$d->brand = $n;
			$d->curr_page = $curr_page;
			return $d;
		}
	
		/*
			Layout_Main::do_build_dropdown($drop_link, $drop_list, $active = false)
			@desc Builds a drop-down menu for a navbar.
			@param $drop_link (string) Link for the trigger link
			@param $drop_list (array)
				{
					Item Text => Item URL
				}
			@param $active = false (bool) Whether or not this is the active item
			@return <div>...</div>... [string]
		*/
		public static function do_build_dropdown($drop_link, $drop_list, $active = false){
			$d = ''; $e = ''; $ac = '';
			if($active === true){ $ac = ' active'; }
			if(is_array($drop_list)){
				$d .= '<a class="navbar-link">' . $drop_link . '</a>';
				foreach($drop_list as $drop_item => $drop_item_url){
					$e .= '<a href="' . Uri::base() . $drop_item_url . '" class="navbar-item">' . $drop_item . '</a>';
				}
			}
			return '
				<div class="navbar-item has-dropdown is-hoverable' . $ac . '">
					' . $d . '
					<div class="navbar-dropdown">
					' . $e . '
					</div>
				</div>
			';
		}
	
		/*
			Layout_Main::do_build_menu($curr_page)
			@desc Builds the links within the main nav.
			@param $curr_page (int)
			@return <a>...</a>... [string]
		*/
		public static function do_build_menu($curr_page){
			$m = ''; $i = 1; $ac = '';
			foreach(\Config::get('ice.menu_items') as $item_txt => $item_url){
				$ac = ''; 
				if(is_array($item_url)){
					if($curr_page === $i){ 
						$ac = true;
					} else {
						$ac = false;
					}
					$m .= Layout_Menu::do_build_dropdown($item_txt, $item_url, $ac);
				} else {
					if($curr_page === $i){ $ac = ' active'; }
					$m .= '<a href="' . Uri::base(true) . $item_url . '" class="navbar-item' . $ac . '"> ' . $item_txt . ' </a>';
				}
				
				$i++;
			}
			return $m;
		}
	}