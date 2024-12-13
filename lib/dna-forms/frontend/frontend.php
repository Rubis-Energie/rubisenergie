<?php
/**
 * Frontend Class
 *
 * @package WordPress
 * @subpackage Forms
 * @since 1.0
 * @author Agence AND DIGITAL <dev@and-digital.fr>
 * @link https://www.and-digital.fr
 */


if (!defined('DNA_FORMS_VERSION')) exit;

/**
 * @since 1.0
 */
class Dna_Forms_Frontend extends Master_Common
{

    function __construct() {
        add_action('template_redirect', array( &$this, 'forms_init_front' ) );
    }

    function display_form($tpl,$param) {
    	$fields = get_field('form_fields', $param["form_id"]);
        $submit_label = get_field('submit_label', $param["form_id"]);
    	$success_message = get_field('success_message', $param["form_id"]);

        $this->display_template('list.fields', array(
                'form_id' => $param["form_id"],
                'fields' => $fields,
                'submit_label' => $submit_label,
                'success_message' => $success_message,
            )
        );
    }

    function field($tpl, $params) {
        $this->display_template('fields/' . $params["layout"], array(
                'data' => $params["data"],
            )
        );
    }

    function forms_init_front() {

        if (isset($_POST["form"])) {
            global $contact_error, $contact_success;

            $form = $_POST["form"];

            $form_fields = get_field('form_fields', $form["id"]);
            $fields = array();
            $files = array();

            $class_form = Generator_Form::forge("form");

            $to_select = '';

            foreach ($form_fields as $f) {
                if (strpos($f["acf_fc_layout"], 'file') !== false) {
                    array_push($files, array('name' => 'file_' . $f["fields"]["name"]));
                } else {
                    if ($f["fields"]["required"]) {
                        array_push($fields, array('name' => $f["fields"]["name"], 'required' => 'true'));
                    } else {
                        array_push($fields, array('name' => $f["fields"]["name"]));
                    }
                }


                if (strpos($f["acf_fc_layout"], 'checkbox') !== false) {
                    if ($f["fields"]["multiple_choice"] && isset($form[$f["fields"]["name"]])) {
                        $values = $form[$f["fields"]["name"]];
                        $form[$f["fields"]["name"]] = "";
                        foreach ($values as $val) {
                            $form[$f["fields"]["name"]] .= $val .  ',';
                        }
                    }
                }

                if (strpos($f["acf_fc_layout"], 'select') !== false)  {
                    $i = 0;
                    foreach ($f["fields"]["options"] as $opt) {
                        if ((int)$form[$f["fields"]["name"]] === $i) {
                            $mail_fields[$f["fields"]["name"]] = $opt["option"];

                            if ($f["fields"]["is_mail_opt"] === true) {
                                $to_select = $opt["mail_opt"];
                            }

                        }
                        $i++;
                    }
                } else {
                    $mail_fields[$f["fields"]["name"]] = $form[$f["fields"]["name"]]; // @TODO A améliorer pour le contenu des champs (select, radio, ...)
                }
            }

            /* upload file */
            if (count($files) > 0) {
                $class_form->set_files($files);
                $class_form->set_upload_folder('files');
                $file = $class_form->upload_files();
            }

            /* Set wich field is required or not */
            $class_form->set_fields($fields);

            $class_form->set_values($form);
            $verified = $class_form->set_google_recaptcha(fo('key_private'));

            if ($verified) {
                $submit = $class_form->check_submit();

                if ($submit) {
                    if (get_field('mail_to', $form["id"])) {
                        $to = '';
                        $i = 1;
                        $size = count(get_field('mail_to', $form["id"]));
                        foreach (get_field('mail_to', $form["id"]) as $mail) {
                            if ($i == $size) {
                                $to .= $mail["mail"];
                            } else {
                                $to .= $mail["mail"] . ',';
                            }
                            $i++;
                        }
                    } else {
                        $to = get_option('admin_email');
                    }

                    // Add mail to if select option field have mail
                    if ($to_select != '') {
                        $to .= ',' . $to_select;
                    }

                    if (isset($file)) {
                        $mail = form_mail('email', get_field('mail_object', $form["id"]), $to, get_field('headline', $form["id"]), $mail_fields, $file);
                    } else {
                        $mail = form_mail('email', get_field('mail_object', $form["id"]), $to, get_field('headline', $form["id"]), $mail_fields);
                    }

                    if ($mail) {
                        wp_redirect(get_the_permalink() . '?form_success=1');
                    } else {
                        $contact_error = __('Impossible d\'envoyer votre demande pour le moment. Veuillez réessayer plus tard.');
                    }
                } else {
                    $contact_error = __('Veuillez renseigner tous les champs obligatoires.');
                }
            } else {
                $contact_error = __('Veuillez valider le champ recaptcha.');
            }
        }



    }
}
