<?php

class CRUD_Menu {

    public function __construct() {

        add_action( 'admin_menu', array($this , 'wpdocs_register_my_custom_menu_page') );
        add_action( 'admin_menu', array($this , 'wpdocs_register_my_custom_sub_menu_page') );

    }

    public function wpdocs_register_my_custom_menu_page() {
        add_menu_page(
            __( 'Users', CRUD_TEXTDOMAIN ),
            __( 'Users Manage', CRUD_TEXTDOMAIN ),
            'manage_options',
            'users-list',
            array($this , 'crud_users'),
            '',
            6
        );
    }

    public function wpdocs_register_my_custom_sub_menu_page() {
		add_submenu_page( 
			'users-list', __( 'Add/Edit User', CRUD_TEXTDOMAIN ), __( 'Add/Edit User', CRUD_TEXTDOMAIN ), 'manage_options', 'add-edit-user', array($this, 'user_add_edit_callback')
		);
	}

    public function crud_users(){

        ?>
        <div class="wrap">
            <h1>
                <?php esc_html_e('Users', CRUD_TEXTDOMAIN);?>
                <a class="page-title-action" href="?page=add-edit-user"><?php esc_html_e('New User', CRUD_TEXTDOMAIN);?></a>
            </h1>
            <div id="poststuffwrap">
                <div id="post-body" class="metabox-holder columns-2">
                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <form method="post">
                            <table id="users-listing" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        global $wpdb;
                                        $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}crud_table"); 
                                        if (!empty($results)) {
                                            foreach ($results as $row) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row->user_fname; ?></td>
                                                    <td><?php echo $row->user_lname; ?></td>
                                                    <td>
                                                        <a class="page-title-action" href="?page=add-edit-user&id=<?php echo $row->user_id; ?>"><?php esc_html_e('Edit', CRUD_TEXTDOMAIN);?></a>
                                                        <a class="page-title-action" href="javascript:void(0);" data-id="<?php echo $row->user_id; ?>"><?php esc_html_e('Delete', CRUD_TEXTDOMAIN);?></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="3">
                                                    No records found.                                                    
                                                </td>
                                                </tr>
                                                <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                <br class="clear">
            </div>
        </div>
        <?php    }

    function user_add_edit_callback(){
        wp_enqueue_style('admin-bootstarp-css');
        ?>
        <div class="wrap">
            <h1>
                <?php esc_html_e('Add/Edit User', CRUD_TEXTDOMAIN);?>
            </h1>
            <?php
            global $wpdb;
            $user_id = isset($_GET['id']) ? sanitize_text_field($_GET['id']) : 0;
            $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}crud_table WHERE user_id = $user_id");
            
            $fname = $lname = ''; 
            if (!empty($row)) {
                $fname = isset($row->user_fname) ? sanitize_text_field($row->user_fname) : '';
                $lname = isset($row->user_lname) ? sanitize_text_field($row->user_lname) : '';
            }
            ?>
            <form method="post" action="" id="add_edit_user_form" novalidate="novalidate">
                <table class="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="fname">First Name</label></th>
                            <td><input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="lname">Last Name</label></th>
                            <td><input type="text" name="lname" id="lname" value="<?php echo $lname; ?>" class="regular-text"></td>
                        </tr>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    </tbody>
                </table>
                <p class="submit">
                    <input type="submit" name="add_user_submit" class="button button-primary" value="Add User">
                </p>
            </form>
        </div>
        <?php
    }
        

}
new CRUD_Menu();