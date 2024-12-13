<?php
/**
 * Theme Theme Functions
 *
 * @package WordPress
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

/*================================================================================== */
/* Global Theme Functions ================================================================ */
function pkr_paging_nav($query = null) {
   if (!$query) {
       $query = $GLOBALS['wp_query'];
   }
   // Don't print empty markup if there's only one page.
   if ( $query->max_num_pages < 2 ) {
       return;
   }

   $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
   $pagenum_link = html_entity_decode( get_pagenum_link() );
   $query_args   = array();
   $url_parts    = explode( '?', $pagenum_link );

   if ( isset( $url_parts[1] ) ) {
       wp_parse_str( $url_parts[1], $query_args );
   }

   $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
   $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

   $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
   $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

   if (is_array($query_args) && isset($query_args[0]) && is_array($query_args[0])) {
      $query_args = array_map( 'urlencode', $query_args );
   }

   // Set up paginated links.
   $links = paginate_links( array(
       'base'     => $pagenum_link,
       'format'   => $format,
       'total'    => $query->max_num_pages,
       'current'  => $paged,
       'mid_size' => 1,
       'add_args' => $query_args,
       'prev_text' => __('<div class="paging__btn paging__btn--left"><div class="pageLinkButton"></div> <span>' . pll__('Page précédente') . '</span></div>'),
       'next_text' => __('<div class="paging__btn paging__btn--right"><span>' . pll__('Page suivante') . '</span> <div class="pageLinkButton"></div></div>'),
       'before_page_number' => '<span class="num">',
       'after_page_number' => '</span>'
       ) );

   return $links;
}
