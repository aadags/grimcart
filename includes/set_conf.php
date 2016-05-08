<?php
/*
  -------------------------------------------------------------------------
      DR webtech's  GRIMCART
              Version 0.1
    This program is free software published under the
    terms of the GNU Lesser General Public License.

    This program is distributed in the hope that it will
    be useful - WITHOUT ANY WARRANTY; without even the
    implied warranty of MERCHANTABILITY or FITNESS FOR A
    PARTICULAR PURPOSE.


	Questions & comments please send to damahrefeay@gmail.com
  -------------------------------------------------------------------------
*/
            if(isset($_GET['set_conf']))
        {
            $shopname = $_GET['shopname'];
            $adminemail = $_GET['adminemail'];
            $contactemail = $_GET['contact'];
            $cuid = $_GET['cuid'];
            $cuiso = $_GET['cuiso'];
            $p_perpage = $_GET['perpage'];
            $paypalemail = $_GET['paypalemail'];
            $content = "<?php
    define('CONF_SHOP_NAME', '".$shopname."');
    define('CONF_GENERAL_EMAIL', '".$contactemail."');
	define('CONF_NOTIFICATION_EMAIL', '".$adminemail."');
	define('CONF_CURRENCY_ID', '".$cuid."');
	define('CONF_CURRENCY_ISO3', '".$cuiso."');
	define('CONF_PAYPAL_EMAIL', '".$paypalemail."');
	define('CONF_PRODUCTS_PER_PAGE', ".$p_perpage.");
     ?>";
          $do =  file_put_contents("conf.php",$content);
          require('../source/include/membersite_config.php');
          if($do)   {$fgmembersite->RedirectToURL('../admin/settings.php?status=saved');}else {$fgmembersite->RedirectToURL('../admin/settings.php?status=notsaved');}
        }

?>
