<?php
/**
 * Common Functions
 *
 * @package WordPress
 * @subpackage Implantation
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */

function get_all_coutries() {
    $countries = array();

    $args = array(
        'post_type' => 'implantation',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => 'imp_name',
    );
    $imp = get_posts($args);


    return $imp;

}

function get_countries_by_continent() {
    $countries = array();

    $args = array(
        'post_type' => 'implantation',
        'posts_per_page' => -1,
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => 'imp_name',
    );
    $imp = get_posts($args);

    if ($imp) {
        foreach ($imp as $i) {
            $cont = get_field('imp_cont', $i->ID);
            $countries[$cont["value"]][] = $i;
        }
    }

    return $countries;

}

function get_continent() {
    $continent = array();

    $args = array(
        'post_type' => 'implantation',
        'posts_per_page' => -1,
    );
    $imp = get_posts($args);

    if ($imp) {
        foreach ($imp as $i) {
            $cont = get_field('imp_cont', $i->ID);

            $continent[$cont["value"]] = $cont["label"];
        }
    }
    return $continent;

}
