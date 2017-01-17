<?php defined('BASEPATH') OR exit('No direct script access allowed');
//CGWPH-IT-Jay
$this->view("common/seller/header"); ?>
<div id="content-banners" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#content-banners" data-slide-to="0" class="active"></li>
      <li data-target="#content-banners" data-slide-to="1"></li>
      <li data-target="#content-banners" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?php echo base_url('../assets/images/home-page/banners/banner-1.png'); ?>" alt="onenow">
            <div class="carousel-caption">
                <h2>Sustainable Crafts</h2>
                <a href="javascript:$('#ModalLogin').modal('show')" class="btn btn-danger">Sign up</a>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url('../assets/images/home-page/banners/banner-2.png'); ?>" alt="onenow">

            <div class="carousel-caption">
                <h2>Meet the Master <br/>Craftsmen & Descendants</h2>
                <a href="<?php echo base_url('/about/master-artisans'); ?>" class="btn btn-danger">Let's Explore</a>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo base_url('../assets/images/home-page/banners/banner-3.png'); ?>" alt="onenow">
            <div class="carousel-caption">
                <h2 style="color:#454545;text-shadow: 1px 1px 3px #727272">Lux by SACICT</h2>
                <a href="<?php echo base_url('/about/coming-soon'); ?>" class="btn btn-danger">Let's Explore</a>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <!--a class="left carousel-control" href="#content-banners" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#content-banners" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>-->
   <!-- <div class="content-banners-caption">
        <h2>Thai Home Collection From <br/>Master Artisans</h2>
        <a href="http://buyer.staging.onenow.com/master-craftsmen" class="btn btn-danger">Let's Explore</a>
    </div>-->
</div>

<div class="pre-banner">
    <div class="row">
        <div class="col-md-4 col-sm-4 ">
            <div class="row pre-div" >
                <img src="<?php echo base_url('onenow/assets/images/icon_lady.png'); ?>">
                <div class=" desc" >
                    <h4>Get something you love</h4>
                    <p>Our marketplace is a world of vintage and handmade goods</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 ">
            <div class="pre-div" >
                <img src="<?php echo base_url('onenow/assets/images/icon_men.png'); ?>">
                <div class="desc">
                    <h4>Get something you love</h4>
                    <p>Our marketplace is a world of vintage and handmade goods</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4">
            <div class="pre-div" >
                <img src="<?php echo base_url('onenow/assets/images/icon_buysafely.png'); ?>">
                <div class="desc">
                    <h4>Get something you love</h4>
                    <p>Our marketplace is a world of vintage and handmade goods</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="margin-top50 margin-bottom50 middle-description container">
    <div class="row ">
        <div class="col-md-8 col-sm-12 left-desc">
            <div class="row " >
                <div class="col-md-3 col-sm-3  col-xs-3 text-align-center">
                    <div>
                        <img src="<?php echo base_url('onenow/assets/images/itune.png'); ?>" class="img-itune-left">
                        <button class="btn btn-primary btn-itune">View in iTunes</button>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 ">
                    <div>
                        <h3>Description</h3>
                        <span >
                            Instagram is a simple way to capture and share the world's moments. Follow your friends and family to see what they're up to, and discover accounts from all over the world that are sharing things you love. Join the community of over 500 million people and express yourself by sharing all the moments of your day--the highlights and everything
                        </span>
                        <div class="margin-top-10" >
                            <a >Instagram, Inc. Web Site<i class="fa  fa-caret-right"></i></a>
                            <a style="margin-left:10px">Instagram Support<i class="fa  fa-caret-right margin-"></i></a>
                            <a class="float-right">...More</a>
                        </div>
                    </div >
                    <div class="margin-top20">
                        <h3>What's New in Version 9.2</h3>
                        <span style="color:#b4b4b4">
                            Announcing a new video channel on Explore that lets you experience events as they happen around the world. This channel collects the best videos from concerts, sporting events and more so you can feel like you're in the front row. This updates to Explore is currently available only in the United States.
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 right-desc">
           <div class="row">
               <div class="col-md-6 col-sm-3 col-xs-3 text-align-center">
                   <img src="<?php echo base_url('onenow/assets/images/itune.png'); ?>" class="img-itune-right">
               </div>
               <div class="col-md-6 col-sm-9">
                   <div style="display: inline-block" >
                       <h2>Instagram</h2>
                       <a>Instagram</a>
                       <a>Social</a>
                   </div>
                   <div class="margin-top50 google-div" style="display: inline-block; background: #f1f1f1; padding:10px; font-size: 20px">
                       <nobr><img src="<?php echo base_url('onenow/assets/images/google.png'); ?>">Google Play</nobr>
                   </div>
               </div>
           </div>
        </div>
    </div>
</div>
<div class="container " style="text-align: center">
    <div class="hori-stick" ></div>
</div>

<div class="container margin-top50 margin-bottom50" style="text-align: center">
    <div >
        <h1>Directing Buyers Straight to the Designers</h1>
    </div>
    <div class="margin-top-10">
        <span style="font-style: italic; font-size: 20px; line-height: 30px" >" Prospecting campaigns on Facebook are historically challenging at high volumes. With Albert, the brain behind adgorithms' Saas, Targeting users with a high probability of converting based on analysis of past campaign performance and user behavior we experienced an increase in revenue far beyond expectations and in record time"<span style="font-style: normal; font-weight: bold">Damien Poelhekke | Head of Benelux at Made.com</span></span>
    </div>
    <h1 class="margin-top50" style="font-size: 45px; font-weight: bold">MADE<sup ><i class="fa  fa-plus" style="font-size: 15px;border-style: solid;border-radius: 30px;padding-left:1px; padding-righ:1px;"></i></sup></h1>
</div>

<div class="subscribe">
    <div class="row">
        <div class="inputdiv col-md-8 col-sm-8 col-xs-8" >
            <input style="padding: 0 20px;" type="text" class="email-bottom" placeholder="Enter email to receive a welcome gift" />
        </div>
        <div class="buttondiv col-md-4 col-sm-4 col-xs-4" >
            <button id="subscribe-btn" class="onenowBtn newredBtn">Subscribe</button>
        </div>
    </div>
</div>
<?php $this->view("common/seller/footer"); ?>