<?php
  session_set_cookie_params(0, '/', 'www.gnomo.fe.up.pt/', true, true);
  session_start();

  function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
  }

  if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generate_random_token();
  }

  // if(!isset($_SESSION['auth_tries'])) {
  // 	$_SESSION['auth_tries'] = 0;
  // }
  

?>
