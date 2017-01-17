<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: CGW-PHIT-Ian <ian.moreno@comgateway.com>
 * Date: 10/18/16 10:36 PM
 * Description:
 */
?>
<title>ONENOW - Our story</title>

<?php $this->view('common/header'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>" />
<style type="text/css">
.story-content-main {
    padding: 10px;
}
.story-banner, .story-text {
    max-width: 1300px;
    margin: auto;
}
.story-banner img {
    width: 100%;
}

.story-text {
    margin-top: 30px;
    padding: 20px;
}
.story-text h2{
    text-align: center;
    font-weight: 600;
}
.story-text p{
    line-height: 35px;
}
</style>
<div class="story-content-main">
    <div class="story-banner">
        <img src="<?php echo base_url('assets/images/home-page/banners/story_banner.png'); ?>">
    </div>
    <div class="story-text">
        <h2 class="title">Our Story</h2>
        <p>
        This is a story about a different kind of marketplace.<br>

        One about opening borders and connecting people.<br>

        One that gathers and showcases the skills and creativity of Thailand to the world sourced from the biggest markets to the most remote villages.<br>

        One where there are no middlemen or outrageous mark-ups, because this is as direct to source as it gets.<br>

        One where language doesn't get in the way, because we thought you might find it useful to have a translator so you can contact the merchants directly.<br>

        Our ethos: Uphold the traditions of the land. Embrace its innovations. Celebrate its people and the ingenuity behind 1000 smiles.<br>

        You'll find world-renowned Thai brands on board. (Because: how could we not?)<br>

        But wait till you meet our other sources. The independent sellers.  Master craftsmen.  Third-generation artisans.  Those whose artistry sings about the land and smells of the earth. Who make things that surprise, things that make you smile. Things made to endure, things made to matter.<br>

        Our is the story of the ingenuity behind the thousand smiles.<br>

        And we're delighted you're here.<br>
        </p>
    </div>
</div>

<?php $this->view('common/footer'); ?>