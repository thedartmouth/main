<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">


<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

  <style>
  .backbutton {
    top: 0;
    left: 0;
    opacity: 0.4;
    z-index: 0;
    height: 50px;
  }
  h1{
    font-size: 32px;
  }
  .backbutton:hover {
    opacity: 1;
  }
  .backbutton a {
    color: black;
    font-weight: bold;
  }
  .backbutton span{
    margin-left:-4px;
  }
  .backbutton img {
    width: 80px;
    margin-right: -10px;
  }
  .col-md-4 {
    padding-bottom: 2%; 
  }
  .mirrorimg {
    max-width: 100%;
    overflow:hidden;
    margin: 0 auto;
  }
  .mirrortxt {
    font-size:20px;
    /*font-size:1.4vw;*/
  }
  .mirrorimgoverlay {
    position: absolute;
    top: 0;
    width: 100%;
    color: black;
    font-weight: bold;
    font-size: 1.5em;
    margin-left: -10px;
        background:rgba(255,255,255,.60);
              text-align:center;
              padding:25% 0 50% 0;
              opacity:0;
              -webkit-transition: opacity .25s ease;
-moz-transition: opacity .25s ease;
  }
  .mirrorimgoverlay:hover {
    opacity: 1;
  }

  </style>
  <div class="backbutton">
   <a href="<?php bloginfo('url');?>"><img style="width:80px;vertical-align:middle" src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/d_isolated.png">
   <span style="">Back to The Dartmouth</span></a>
</div>
      <div class="row" style="text-align: center; margin: 0; margin-top: 40px; padding: 0">
        
        <div class="col-md-4 mirrortxt"><h1 style="text-align: center;">The Mirror: Restaurants</h1><h6>Photographs by Tiffany Zhao, The Dartmouth Staff. Text by James Jia.</h6>
          <br>The Mirror dives into Hanover's restaurant scene.</div>

        <div class="col-md-4">
        <img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/04/4.3.15.Mirror.thaiorchid2_Tiffany.Zhai_.jpg">
        <a href="<?php bloginfo('url');?>/2015/04/03/thai-orchid/"><div class="mirrorimgoverlay">
        Thai Orchid
        </div></a>
        </div>

        <div class="col-md-4"><img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/04/4.3.15.Mirror.jewelofindia5_Tiffany.Zhai_.jpg">
                <a href="<?php bloginfo('url');?>/2015/04/02/jewel-of-india/"><div class="mirrorimgoverlay">
        Jewel of India
        </div></a></div>
      </div>
      <div class="row" style="text-align: center; margin: 0; margin-top: 10px; padding: 0">
        <div class="col-md-4"><img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/04/4.3.15.Mirror.ebas4_Tiffany.Zhai_.jpg">
                <a href="<?php bloginfo('url');?>/2015/04/02/ebas/"><div class="mirrorimgoverlay">
        EBAs
        </div></a></div>
        <div class="col-md-4"><img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/04/4.3.15.Mirror.canoeclub2_Tiffany.Zhai_.jpg">
          <a href="<?php bloginfo('url');?>/2015/04/02/canoe-club/"><div class="mirrorimgoverlay">
        Canoe Club
        </div></a></div>
        <div class="col-md-4"><img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/04/4.3.15.Mirror.BaseCamp_Tiffany.Zhai_.jpg">
          <a href="<?php bloginfo('url');?>/2015/04/02/base-camp-cafe/"><div class="mirrorimgoverlay">
        Base Camp Cafe
        </div></a></div>
      </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>