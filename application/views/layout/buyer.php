<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 9/27/16 10:10 AM
 * Description: Layout for buyer page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Onenow Thailand</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?php echo base_url('assets/ico/favicon.png'); ?>" />
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/3.3.7/css/bootstrap.min.css');?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/4.6.3/css/font-awesome.min.css'); ?>" />
    <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>" />
</head>
<body>
    <layout />

    <!--<script>paceOptions={elements:true};</script>
    <script src="<?php /*echo base_url('assets/js/pace.min.js'); */?>"></script>-->
    <!-- Just for debugging purposes. -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo base_url('assets/vendor/html5shiv/3.7.0/html5shiv.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/vendor/respond.js/1.3.0/respond.min.js'); ?>"></script>
    <![endif]-->

    <script type="text/javascript" src="<?php echo base_url('assets/vendor/jquery/1.10.1/jquery.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/script.js');?>"></script>
<?php if(! $this->session->has_userdata('locale')): ?>
    <script type="text/javascript" src="http://loc.comgateway.com/location/localelookup.jsp"></script>
    <script type="text/javascript">$(function(){$.post('<?php echo base_url('buyer/locale'); ?>',cgwgeoresponse);});</script>
<?php endif; ?>
</body>
</html>