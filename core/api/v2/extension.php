<?php
/**
 * Copyright (c) 2014-2018, www.kuacg.com
 * All right reserved.
 *
 * @since 2.5.0
 * @package Tint-K
 * @author 酷ACG资源网
 * @date 2018/02/14 10:00
 * @link https://www.kuacg.com/18494.html
 */
?>

<?php

/**
 * 拦截并重载默认的基于Cookies用户认证方式，采用OAuth的Access Token认证
 *
 * @since   x.x.x
 *
 * @param   int | false    $user_id     用户ID
 * @return  int | false
 */
function tt_install_token_authentication($user_id){
    // TODO: token verify and find the user_id
    return false;
}
add_filter('determine_current_user', 'tt_install_token_authentication', 5, 1);

remove_filter( 'determine_current_user', 'wp_validate_auth_cookie' );
remove_filter( 'determine_current_user', 'wp_validate_logged_in_cookie', 20 );