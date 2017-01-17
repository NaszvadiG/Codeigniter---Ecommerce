<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/25/16 2:56 PM
 * Description:
 */
?>
<title>ONENOW - Master Artisans</title>
<?php $this->view('common/header'); ?>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/mobile.css'); ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/about.css'); ?>" />

<div class="banner responsive-fullwidth">
    <div class="full-container" style="position: relative;">
        <div>
            <h1>About SACICT</h1>
            <h1>(pronounced "Sak-Sith")</h1>
        </div>
        <img src="<?php echo base_url('assets/images/about/package5/banner1.png'); ?>" class="image-responsive">
    </div>

</div>

<div class="container margin-top50 margin-bottom50 section">
    <h1>Background</h1>
    <div class="margin-top-10">
        <span >His Majesty King bhumibol Adulyadej graciously issued the Royal Decree for the establishment of  the SUPPORT Arts and Crafts International Center of Thailand on September 20th 2003. The centre was officially established as of November 1st, 2003 and called "SACICT" (pronounced "Sak-Sith") for short according to it's initial.</span>
    </div>
</div>

<div class="row responsive-fullwidth">
    <div class="col-md-6 col-sm-6 col-xs-6 no-padding ">
        <img src="<?php echo base_url('assets/images/about/package5/img1.png'); ?>" class="image-responsive">
    </div>
    <div class="col-md-6 col-sm-6 col-xs-6 no-padding ">
        <img src="<?php echo base_url('assets/images/about/package5/img2.png'); ?>" class="image-responsive">
    </div>
</div>

<div class="container margin-top50 margin-bottom50 section">
    <h1></h1>
    <div class="margin-top-10">
        <span >SACICT's main objectives are to support and promote the market for arts and crafts domestically and internationally; to serve as a common ground for producers, importers and exporters to meet and negotiate; and to supervise and protect the copyrights, patents and intellectual properties, as well as to give legal advice and standard certification for Thailand's artistic and handicraft goods.</span>
    </div>
</div>

<div class="row responsive-fullwidth">
    <div class="col-md-12 col-sm-12 col-xs-12 no-padding ">
        <img src="<?php echo base_url('assets/images/about/package5/img3.png'); ?>" class="image-responsive">
    </div>
</div>



<div class="row responsive-fullwidth">
    <div class="col-md-3 col-sm-3 col-xs-6 no-padding sacict-item">
        <a href="/home-and-living">
            <img src="<?php echo base_url('assets/images/about/package5/img7.png'); ?>" class="image-responsive">
        </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 no-padding sacict-item">
        <a href="/home-and-living">
            <img src="<?php echo base_url('assets/images/about/package5/img6.png'); ?>" class="image-responsive">
        </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 no-padding sacict-item">
        <a href="/home-and-living">
            <img src="<?php echo base_url('assets/images/about/package5/img5.png'); ?>" class="image-responsive">
        </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 no-padding sacict-item">
        <a href="/home-and-living">
            <img src="<?php echo base_url('assets/images/about/package5/img4.png'); ?>" class="image-responsive">
        </a>
    </div>
</div>

<?php $this->view('common/footer'); ?>