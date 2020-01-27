<?php
error_reporting(0);

$rtitle = 'Change Password | Superadmin Dashboard'; //  set page title
$rtype = 'superadmin';
include '../r.header.php';

if( RTYPE != 'superadmin' ){ $rsg->admin_login_redirect(); }

?>
    
    <script language="javascript" type="text/javascript">
        function valid(){
            if(document.form1.newpass.value!= document.form1.confirmpassword.value) {
                alert("New passwords do not match  !!");
                document.form1.newpass.focus();
                return false;
            } 
            return true;
        }
    </script>
<?php 
echo '<section id="container" >';
    include 'temps/r.head_nav.php'; 
    include 'temps/r.side_nav.php';
    include 'temps/r.change_pass.php';
echo '</section>';

include '../r.footer.php';
