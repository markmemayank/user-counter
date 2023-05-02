<?php
/*
Plugin Name: User Role Counter
Plugin URI: https://markmemayank.com
Description: Counts the number of admins, contributors, authors, editors, and subscribers.
Version: 1.0
Author: Mayank Kumar
Author URI: https://markmemayank.com/
*/

function urc_count_users_by_role() {
    $roles = array('administrator', 'contributor', 'author', 'editor', 'subscriber');
    $counts = array();
    foreach ($roles as $role) {
        $counts[$role] = count_users()['avail_roles'][$role];
    }
    return $counts;
}

function urc_display_users_by_role() {
    $counts = urc_count_users_by_role();
    ?>
    <div class="urc-users-by-role">
        <h3>User Role Counts</h3>
        <table>
            <?php foreach ($counts as $role => $count) { ?>
                <tr>
                    <td><?php echo ucfirst($role); ?>:</td>
                    <td><?php echo $count; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}

function urc_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'urc_users_by_role_widget',
        'User Role Counter',
        'urc_display_users_by_role'
    );
}

add_action('wp_dashboard_setup', 'urc_add_dashboard_widget');
