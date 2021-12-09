<?php

/**
 * Convert_Docx_To_Posts
 *
 * @package   Convert_Docx_To_Posts
 * @author    Trinh Quoc manh <trinhquocmanh1990@gmail.com>
 * @copyright 2020
 * @license   GPL 2.0+
 * @link
 */

namespace Convert_Docx_To_Posts\Backend;

use Convert_Docx_To_Posts\Engine\Base;

/**
 * Create the settings page in the backend
 */
class Settings_Page extends Base
{

    /**
     * Initialize the class.
     *
     * @return void|bool
     */
    public function initialize()
    {
        if (!parent::initialize()) {
            return;
        }

        // var_dump(debug_backtrace());
        // Add the options page and menu item.
        \add_action('admin_menu', array( $this, 'add_plugin_admin_menu' ));

        $realpath        = (string) \realpath(\dirname(__FILE__));
        $plugin_basename = \plugin_basename(\plugin_dir_path($realpath) . CDTP_TEXTDOMAIN . '.php');
        \add_filter('plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ));

        // var_dump($this->settings);
        if (
            isset($_GET['page']) &&
            $_GET['page'] == CDTP_TEXTDOMAIN &&
            $_SERVER['REQUEST_METHOD'] == 'POST'
        ) {
            $nonce_context = 'nonce_CMB2phpconvert-docx-to-posts_options';
            $nonce = $_POST[$nonce_context];
            $verified = \wp_verify_nonce($nonce, $nonce_context);
            if (!$verified) {
                return;
            }
            $field_key = '_file_docx';
            $field = $_POST[$field_key];
            $attachment_id = \attachment_url_to_postid($field);
            if (is_int($attachment_id) && $attachment_id > 0) {
                $file_path = \get_attached_file($attachment_id);
                if (!$this->validateExt($file_path)) {
                    return;
                }
                $htmlContent = $this->getHmltContentFromDocx($file_path);
                $postArr = $this->convertHtmlToPostArr($htmlContent);
                $count = $this->createPosts($postArr);
                if ($count > 0) {
                    $this->deleteFile($attachment_id);
                    $this->postCreated = $count;
                }
            }
        }
    }

    protected $postCreated = 0;
    protected $error = '';

    protected function validateExt(string $file_path): bool
    {
        // var_dump($file_path);
        $valid = true;
        $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($extension != 'docx') {
            $valid = false;
            $this->error = 'File có định dạng không phù hợp: ' . $extension . '. Chỉ chấp nhận file docx';
        }
        return $valid;
    }

    protected function deleteFile($postId)
    {
        \wp_delete_attachment($postId, true);
        $field_key = '_file_docx';
        $_POST[$field_key] = '';
        unset($_POST['_file_docx_id']);
    }

    protected function createPosts(array $postArr): int
    {
        $count = 0;
        foreach ($postArr as $postInfo) {
            $post = array(
                'post_title' => $postInfo['title'],
                // 'post_status' => 'publish',
                'post_content' => $postInfo['content']
            );
            $new_post = wp_insert_post($post);
            if (!is_wp_error($new_post)) {
                $count ++;
                wp_publish_post($new_post);
                // var_dump($new_post);
            }
        }
        return $count;
    }

    protected function getHmltContentFromDocx(string $filePath): string
    {
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($filePath);
        $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
        // $htmlWriter->save('test1doc.html');

        // $class_method = get_class_methods($htmlWriter);
        // var_dump($class_method);
        // var_dump($htmlWriter);
        // return '';
        return $htmlWriter->getContent();
    }

    protected function convertHtmlToPostArr(string $html): array
    {
        $postArr = [
            // 0 => [
            // 	'title' => 'Tiêu đề',
            // 	'content' => 'Nội dung'
            // ]
        ];
        $has_match = preg_match(
            '/<body>(.*)<\/body>/is',
            $html,
            $matches
        );
        if ($has_match != 1) {
            return '';
        }
        // var_dump($matches[1]);
        $html = $matches[1];
        // var_dump($html);
        $postArr = $this->convertHtmlToPost($html, $postArr);
        return $postArr;
    }

    protected function convertHtmlToPost(string $html, array $postArr): array
    {
        $regex = '/<h1>(.*)<\/h1>/i';
        $has_match = preg_match(
            $regex,
            $html,
            $matches,
            PREG_OFFSET_CAPTURE
        );
        if (
            $has_match != 1 ||
            count($matches) < 2
            ) {
            return $postArr;
        }
        // var_dump($matches);
        $tag_title = $matches[0][0];
        $cut_off_pos = $matches[0][1];
        $post_title = $matches[1][0];
        $post_content = substr($html, 0, $cut_off_pos);
        array_push($postArr, [
            'title' => $post_title,
            'content' => $post_content
        ]);
        $tag_title_length = strlen($tag_title);
        $remain_content = substr($html, $cut_off_pos + $tag_title_length);
        if (!empty($remain_content)) {
            $postArr =  $this->convertHtmlToPost($remain_content, $postArr);
        }
        return $postArr;
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since 1.0.0
     * @return void
     */
    public function add_plugin_admin_menu()
    {
        /*
         * Add a settings page for this plugin to the Settings menu
         *
         * @TODO:
         *
         * - Change 'manage_options' to the capability you see fit
         *   For reference: http://codex.wordpress.org/Roles_and_Capabilities

        add_options_page( __( 'Page Title', CDTP_TEXTDOMAIN ), CDTP_NAME, 'manage_options', CDTP_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' ) );
         *
         */
        /*
         * Add a settings page for this plugin to the main menu
         *
         */
        \add_menu_page(\__('Convert Docx To Posts Settings', CDTP_TEXTDOMAIN), CDTP_NAME, 'manage_options', CDTP_TEXTDOMAIN, array( $this, 'display_plugin_admin_page' ), 'dashicons-hammer', 90);
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since 1.0.0
     * @return void
     */
    public function display_plugin_admin_page()
    {
        include_once CDTP_PLUGIN_ROOT . 'backend/views/admin.php';
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since 1.0.0
     * @param array $links Array of links.
     * @return array
     */
    public function add_action_links(array $links)
    {
        return \array_merge(
            array(
                'settings' => '<a href="' . \admin_url('options-general.php?page=' . CDTP_TEXTDOMAIN) . '">' . \__('Settings', CDTP_TEXTDOMAIN) . '</a>',
                // 'donate'   => '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=danielemte90@alice.it&item_name=Donation">' . \__('Donate', CDTP_TEXTDOMAIN) . '</a>',
            ),
            $links
        );
    }
}