<?php

/*
 * OpenDev
 * Country Manager
 */

class Odm_Country_Manager {

  var $countries = [
    'cambodia' => array('name' => 'Cambodia', 'theme' => 'cambodia', 'code' => 'kh', 'lang' => 'km', 'url' => 'https://cambodia.opendevelopmentmekong.net', 'url_pp' => 'https://cambodia.pp.opendevelopmentmekong.net'),
    'laos' => array('name' => 'Laos', 'theme' => 'laos', 'code' => 'lo', 'lang' => 'la', 'url' => 'https://laos.opendevelopmentmekong.net', 'url_pp' => 'https://laos.pp.opendevelopmentmekong.net'),
    'mekong' => array('name' => 'Mekong', 'theme' => 'mekong', 'code' => 'mekong', 'lang' => null, 'url' => 'https://opendevelopmentmekong.net', 'url_pp' => 'https://pp.opendevelopmentmekong.net'),
    'myanmar' => array('name' => 'Myanmar', 'theme' => 'myanmar', 'code' => 'mm', 'lang' => 'my', 'url' => 'https://myanmar.opendevelopmentmekong.net', 'url_pp' => 'https://myanmar.pp.opendevelopmentmekong.net'),
    'thailand' => array('name' => 'Thailand', 'theme' => 'thailand', 'code' => 'th', 'lang' => 'th', 'url' => 'https://thailand.opendevelopmentmekong.net', 'url_pp' => 'https://thailand.pp.opendevelopmentmekong.net'),
    'vietnam' => array('name' => 'Vietnam', 'theme' => 'vietnam', 'code' => 'vn', 'lang' => 'vi', 'url' => 'https://vietnam.opendevelopmentmekong.net', 'url_pp' => 'https://vietnam.pp.opendevelopmentmekong.net')
  ];

	function __construct() {
    //
	}

  function is_pp(){
    return strpos($_SERVER['HTTP_HOST'], 'pp.') !== false;
  }

  function get_current_country(){
    $options = get_option('odm_options');
    $current_country = 'mekong';
    if ( isset($options['style'])):
      $current_country = $options['style'];
    endif;
    return $current_country;
  }

  function get_country_themes(){
    return [
      'Mekong' => 'mekong',
      'Cambodia' => 'cambodia',
      'Thailand' => 'thailand',
      'Laos' => 'laos',
      'Myanmar' => 'myanmar',
      'Vietnam' => 'vietnam'
    ];
  }

  function get_country_codes(){
    return [
      'mekong' => 'mekong',
      'cambodia' => 'kh',
      'thailand' => 'th',
      'laos' => 'lo',
      'myanmar' => 'mm',
      'vietnam' => 'vn'
    ];
  }

  function get_country_name($country){

    if (!array_key_exists($country,$this->countries)):
      return null;
    endif;

    return $this->countries[$country]['name'];
  }

  function echo_country_selectors(){
  ?>
    <ul class="country-selector">
      <?php
        foreach ($this->countries as $country):
          $url = $this->is_pp() ? $country['url_pp'] : $country['url'];
          $path_without_lang = remove_language_code_from_url($_SERVER['REQUEST_URI']);
          $destination = $url . $path_without_lang;
          if ($this->is_current_country($country)): ?>
            <li class="active-country"><?php od_logo_icon($country['name']); echo __($country['name']);?></li>
          <?php else: ?>
            <li><a href="<?php echo $destination; ?>"><?php od_logo_icon($country['name']); ?><?php echo __($country['name']);?></a></li>
          <?php endif; ?>
      <?php
        endforeach;
      ?>
    </ul>
  <?php
  }

  function is_current_country($country){
    return $this->get_current_country() == $country['theme'];
  }

}

$GLOBALS['odm_country_manager'] = new Odm_Country_Manager();

function odm_country_manager() {
	return $GLOBALS['odm_country_manager'];
}

?>
