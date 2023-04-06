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
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011-04-25</td>
                                            <td>$320,800</td>
                                            <td>
                                                <a class="page-title-action" href="?page=add-edit-user&"><?php esc_html_e('Edit', CRUD_TEXTDOMAIN);?></a>
                                                <a class="page-title-action" href="#"><?php esc_html_e('Delete', CRUD_TEXTDOMAIN);?></a>
                                        </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
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

            <form method="post" action="" id="add_edit_user_form" novalidate="novalidate">
                <table class="form-table" role="presentation">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="fname">First Name</label></th>
                            <td><input type="text" name="fname" id="fname" value="<?php ?>" class="regular-text"></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="lname">Last Name</label></th>
                            <td><input type="text" name="lname" id="lname" value="<?php ?>" class="regular-text"></td>
                        </tr>
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