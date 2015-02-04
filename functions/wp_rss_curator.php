<?php

  $adClient = esc_attr( get_option('adsense_id') );
  $total_posts = esc_attr( get_option('site_total_posts') ) == '' ? '20' : esc_attr( get_option('site_total_posts') );
  $random_posts = esc_attr( get_option('site_randomise_posts') ) == '' ? true : get_option('site_randomise_posts');

  // Get RSS Feed(s)
  include( ABSPATH . WPINC . '/class-simplepie.php' );

  // Get a SimplePie feed object from the specified feed source.
  $fish = array( 
        get_option('site_url_one')  ?: get_option('site_url_one'), 
        get_option('site_url_two')  ?: get_option('site_url_two'), 
        get_option('site_url_three')?: get_option('site_url_three'), 
        get_option('site_url_four') ?: get_option('site_url_four'), 
        get_option('site_url_five') ?: get_option('site_url_five'), 
  );

  $main_list = array();
  $footer_one = array();
  $footer_two = array();
  $single_footer = array();
  
  $feed = new Simplepie( array_filter( $fish ) , get_template_directory() . '/cache' );

  $links = [];

  $max = $feed->get_item_quantity();

  for ($x = 0; $x < $max; $x++) {

    $item = $feed->get_item($x);

    $links[$x] = $item->get_permalink();

    //Get then item content from the RSS feed
    $data = esc_html( $item->get_content() );

    //Check if we can find an image
    preg_match('/<img[^>]+>/i' , $item->get_content() , $match );

    //Get the Image HTML
    if( strpos($match[0], 'class') ) {
      $img = str_replace ( 'class="' , 'class="img-responsive ' , $match[0] );
    } else {
      $img = str_replace ( 'src="' , 'class="img-responsive" src="' , $match[0] );
    }    

    //We have found an image! Create the item
    if(strlen($img)>10) {

      if( count($main_list) != 7 ) {

        $main_list[] = create_main_item( $item , $img );

      } elseif (count( $footer_one ) != 4 ) {
        
        $footer_one[] = create_footer_item( $item , $img );

      } elseif (count( $footer_two ) != 4 ) {
        
        $footer_two[] = create_footer_item( $item , $img );

      }
    }
  }

  if(in_array($_GET['item'], $links)) {

    $key = array_search($_GET['item'], $links);
    
    $item = $feed->get_item($key);

    //Get then item content from the RSS feed
    $data = esc_html( $item->get_content() );

    //Check if we can find an image
    preg_match('/<img[^>]+>/i' , $item->get_content() , $match );

    //Get the Image HTML
    if( strpos($match[0], 'class') ) {
      $img = str_replace ( 'class="' , 'class="img-responsive ' , $match[0] );
    } else {
      $img = str_replace ( 'src="' , 'class="img-responsive" src="' , $match[0] );
    }  

    $item_html  = '<div class="item">';
    $item_html .= '<h2>';
    $item_html .= esc_html( $item->get_title() ) . '</a></h2>';
    $item_html .= '<p class="text-center">';
    $item_html .= $img . '</a></p>';
    $item_html .= '<h2 class="text-center">';



    $item_html .=          '<ins class="adsbygoogle"';
    $item_html .=             'style="display:block"';
    $item_html .=              'data-ad-client="'.$adClient.'"';
    $item_html .=             'data-ad-format="auto"></ins>';
    $item_html .=         '<script>';
    $item_html .=         '(adsbygoogle = window.adsbygoogle || []).push({});';
    $item_html .=         '</script>';


    $item_html .= ' <a href="'.esc_url( $item->get_permalink() ).'" title="'.$item->get_date('j F Y | g:i a').'">Click here to read full article ></h2></a>';

    $item_html .= '</div>';

    array_unshift($main_list, $item_html);

  }

  

  function create_main_item( $item , $img ) 
  {
        $item_html  = '<div class="item">';
        $item_html .= '<h2><a href="'. esc_url( $item->get_permalink() ) .'" title="'. $item->get_date('j F Y | g:i a') .'">';
        $item_html .= esc_html( $item->get_title() ) .'</a></h2>';
        $item_html .= '<p class="text-center">'.$img . '</p><br />';

        $descript = strip_tags( $item->get_description() );

        //If the item has a long enough description, show it.
        if(strlen($descript)>10) {
          $item_html .= substr( $descript , 0 , 150 ) .'... | <a href="'.site_url(). '?item=' . esc_url( $item->get_permalink() ) .'">Read More...</a>';
        }

        $item_html .= '</div>';

        return $item_html;
  }

  function create_footer_item( $item , $img ) 
  {
      $item_html .= '<div class="footer-item">';
      $item_html .= '<a href="'.site_url(). '?item=' . esc_url( $item->get_permalink() ) .'" title="'. $item->get_date('j F Y | g:i a') .'">';
      $item_html .= $img;
      $item_html .= '<p class="text-center">'.$item->get_title().'</p></a>';
      $item_html .= '</div>';

      return $item_html;
  }

  function dd( $value = 'fish' )
  {
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
  }


 ?>