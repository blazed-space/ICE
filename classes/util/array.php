<?php
	/* 
			ice::Util_Array
			/classes/util/array.php
			
			ICE
			Created by: Blazed Labs LLC [ https://blazedlabs.com/ ]
			(c)2021 https://github.com/blazed-space/ICE
			
	*/
namespace ice;
class Util_Array{
    /*
        * Util_Array::buildActiveArray($conf)
        *	@desc Builds an array of "active" elements for use in static site generation.
        *	@param $conf (array)
            *       'page'  =   Current active page # (int)
            *       'max'   =   Number of pages to include in final array     
        *	@return [array]
    */
    public static function buildActiveArray($conf){
        $active = array();
            for($i = 0; $i <= $conf['max']; $i++){
              $e = '';
              if(isset($conf['page'])):
                if($i == $conf['page']){
                  $e = ' active'; 
                }
              endif;
              $active[$i] = $e;
            } 
            return $active;
    }
}