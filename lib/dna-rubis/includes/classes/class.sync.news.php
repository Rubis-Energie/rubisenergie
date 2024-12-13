<?php

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @since 1.0
 */
class Dna_Sync_News {

    public function sync_news_process() {
        $news = $this->get_data_from_flux();

        if (count($news)) {
            foreach ($news as $n) {
                $this->add_post($n);
            }
        }

    }

    protected function get_data_from_flux() {
        $news_wp = array();

        $options = [
    	    "ssl" => [
    	        "verify_peer"=>true,
    	        "verify_peer_name"=>true
    	    ]
    	];

        $xml_content = file_get_contents("https://www.rubis-team.net/news/rubis-energie/rss.php?MDP=PassRubiNewss8", false, stream_context_create($options));
        $xml_tab = simplexml_load_string($xml_content);
        // $json = json_encode($xml_tab);
        if ($xml_tab != false) {
            $i = 1;
            foreach ($xml_tab->channel->item as $news) {
                $json = json_encode($news);
                $new = json_decode($json,TRUE);
                if (isset($new["english"]) && !is_array($new["english"]["title"])) {
                    $news_wp[$i]["en"]["title"] = $new["english"]["title"];
                    $news_wp[$i]["en"]["text"] = $new["english"]["description"];
                    $news_wp[$i]["en"]["date"] = $new["english"]["pubDate"];
                }
                if (isset($new["french"]) && !is_array($new["french"]["title"])) {
                    $news_wp[$i]["fr"]["title"] = $new["french"]["title"];
                    $news_wp[$i]["fr"]["text"] = $new["french"]["description"];
                    $news_wp[$i]["fr"]["date"] = $new["french"]["pubDate"];

                    if (isset($new["photos"])) {
                        $nb_photos = count($new["photos"]);

                        for ($j=1; $j <= $nb_photos; $j++) {
                            $news_wp[$i]["photos"][$j] = $new["photos"]["photo" . $j];
                        }

                    }

                }
                $i++;
            }
        }
        return $news_wp;
    }

    protected function add_post($data) {
        $post_id_fr = false;
        $post_id_en = false;

        if (!is_admin()) {
            require_once( ABSPATH . 'wp-admin/includes/post.php' );
        }

        if (isset($data["fr"])  && (post_exists($data["fr"]["title"]) == 0)) {
            $args_fr = array(
                'post_type' => 'post',
                'post_title' => $data["fr"]["title"],
                'post_status' => 'draft',
                'post_content' => $data["fr"]["text"],
                'post_date' => date('Y-m-d', strtotime($data["fr"]["date"])),
            );
            $post_id_fr = wp_insert_post($args_fr);
            pll_set_post_language($post_id_fr, 'fr');
        } else {
            $post_id_fr = post_exists($data["fr"]["title"]);
        }

        if (isset($data["en"]) && (post_exists($data["en"]["title"]) == 0)) {
            $args_en = array(
                'post_type' => 'post',
                'post_title' => $data["en"]["title"],
                'post_status' => 'draft',
                'post_content' => $data["en"]["text"],
                'post_date' => date('Y-m-d', strtotime($data["en"]["date"])),
            );
            $post_id_en = wp_insert_post($args_en);
            pll_set_post_language($post_id_en, 'en');
        } else {
            $post_id_en = post_exists($data["en"]["title"]);
        }

        if ($post_id_fr != false && $post_id_en != false) {
            pll_save_post_translations(array('fr' => $post_id_fr, 'en' => $post_id_en));
        }

        if (isset($data["photos"])) {
            delete_field('post_imgs', $post_id_fr);
            delete_field('post_imgs', $post_id_en);

            $l = 0;
            foreach ($data["photos"] as $photo) {
                $pathinfo = pathinfo($photo["nom"]);

                if ($pathinfo["extension"] == "png") {
                    $img = str_replace('data:image/png;base64,', '', $photo["photo"]);
                } elseif ($pathinfo["extension"] == "JPG") {
                    $img = str_replace('data:image/JPG;base64,', '', $photo["photo"]);
                } elseif ($pathinfo["extension"] == "jpg") {
                    $img = str_replace('data:image/jpg;base64,', '', $photo["photo"]);
                } elseif ($pathinfo["extension"] == "jpeg") {
                    $img = str_replace('data:image/jpeg;base64,', '', $photo["photo"]);
                }
                // var_dump($img);die;
                if ($l == 0) {
                    $this->create_image($img, $photo["nom"], $post_id_fr, $post_id_en, $pathinfo, true);
                } else {
                    $this->create_image($img, $photo["nom"], $post_id_fr, $post_id_en, $pathinfo);
                }
                $l++;
            }
        }
        return true;
    }

    protected function create_image($string_img, $name_img, $post_id_fr, $post_id_en, $pathinfo, $first_img = false) {
        if ($this->checkIfThumbExist($name_img, 'image')) {
            $attach_id = $this->checkIfThumbExist($name_img, 'image');

            if ($first_img) {
                set_post_thumbnail($post_id_fr, $attach_id);
                set_post_thumbnail($post_id_en, $attach_id);
            } else {
                add_row('post_imgs', array('img' => $attach_id), $post_id_fr);
                add_row('post_imgs', array('img' => $attach_id), $post_id_en);
            }

        } else {

            $data = base64_decode($string_img);
            $img = imagecreatefromstring($data);

            $upload_dir = wp_upload_dir();
            $unique_file_name = wp_unique_filename($upload_dir['path'], $name_img);
            $filename = basename($unique_file_name);

            if (wp_mkdir_p($upload_dir['path'])) {
                $file = $upload_dir['path'] . '/news/' . $filename;
            } else {
                $file = $upload_dir['basedir'] . '/news/' . $filename;
            }

            // imagecreatefrompng($img, $file);
            if ($pathinfo["extension"] == "png") {
                $new_img = imagepng($img, $file);
            } elseif ($pathinfo["extension"] == "jpg" || $pathinfo["extension"] == "jpeg" || $pathinfo["extension"] == "JPG") {
                $new_img = imagejpeg($img, $file);
            }
            imagedestroy($img);

            $wp_filetype = wp_check_filetype($filename, null);

            $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title'     => sanitize_file_name( $filename ),
                'post_content'   => '',
                'post_status'    => 'inherit'
            );

            $attach_id = wp_insert_attachment($attachment, $file);

            require_once(ABSPATH . 'wp-admin/includes/image.php');

            $attach_data = wp_generate_attachment_metadata($attach_id, $file);

            wp_update_attachment_metadata($attach_id, $attach_data);

            if ($first_img) {
                set_post_thumbnail($post_id_fr, $attach_id);
                set_post_thumbnail($post_id_en, $attach_id);
            } else {
                add_row('post_imgs', array('img' => $attach_id), $post_id_fr);
                add_row('post_imgs', array('img' => $attach_id), $post_id_en);

            }
        }
    }

    protected function checkIfThumbExist($img_name, $mime_type = 'image') {
        $name = str_replace(' ', '-', $img_name);
        $args = array(
            'post_type' => 'attachment',
            'post_mime_type' => $mime_type,
            'post_status' => 'inherit',
            'title' => $name,
            'posts_per_page' => -1,
        );

        $images = new WP_Query($args);
        if (sizeof($images->posts) > 0) {
            foreach ($images->posts as $img) {
                $attach_id = $img->ID;
                break;
            }
            return $attach_id;
        } else {
            return false;
        }
    }

    protected function delete_all_row_values($post_id,$field_name) {
        $i = 1;
        if (have_rows($field_name, $post_id)) {
            while (have_rows($field_name, $post_id)) {
                the_row();
                delete_row($field_name,$i,$post_id);
                $i++;
            }
        }
    }

}
