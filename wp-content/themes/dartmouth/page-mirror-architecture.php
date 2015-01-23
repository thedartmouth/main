<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

  <style>
  .backbutton {
    top: 0;
    left: 0;
    opacity: 0.4;
    z-index: 0;
    height: 50px;
  }
  h1{
    font-size: 36px;
  }
  .backbutton:hover {
    opacity: 1;
    cursor: pointer;
  }
  .backbutton img {
    width: 80px;
    margin-right: -10px;
    vertical-align:middle;
  }
  .col-md-4 {
    padding-bottom: 2%; 
  }
  .mirrorimg {
    max-width: 70%;
    margin: 0 auto;
  }
  .mirrorimg:hover {

  }
  .mirrortxt {
    font-size:24px;
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
    cursor: pointer;
  }

  </style>
  <a href="<?php bloginfo('url');?>"><div class="backbutton">
   <img src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/d_isolated.png">
   <span style="color: black;">Back to <b>The Dartmouth</b></span>
</div></a>
      <div class="row" style="text-align: center; margin: 0; margin-top: 40px; padding: 0">
        <div class="col-md-4">
        <img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/01.23.15.Mirror.Bartlett-Hall_Natalie-Cantave-cropped1.jpg">
        <a href="<?php bloginfo('url');?>/2015/01/22/bartlett-hall/"><div class="mirrorimgoverlay">
        Bartlett Hall
        </div></a>
        </div>
        <div class="col-md-4 mirrortxt"><h1 style="text-align: center;">The Mirror: Architecture</h1>
        This week, The Mirror took a deeper look at some of the architectural spaces that define this campus. To learn more about each building, click on the photo.</div>
        <div class="col-md-4"><img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/01.23.15.Mirror.The-Green_Abiah-Pritchard-cropped1.jpg" />
        <a href="<?php bloginfo('url');?>/2015/01/22/the-green/"><div class="mirrorimgoverlay">
        The Green
        </div></a></div>
      </div>
      <div class="row" style="text-align: center; margin: 0; margin-top: 10px; padding: 0">
        <div class="col-md-4"><img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/01.23.15.Mirror.Choates_Natalie-Cantave-cropped1.jpg" />
        <a href="<?php bloginfo('url');?>/2015/01/22/the-choates-residential-cluster/"><div class="mirrorimgoverlay">
        The Choates
        </div></a></div>
        <div class="col-md-4"><img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/01.23.15.Mirror.Dartmouth-Hall_Abiah-Pritchard-cropped1.jpg" /> 
          <a href="<?php bloginfo('url');?>/2015/01/22/dartmouth-hall/"><div class="mirrorimgoverlay">
        Dartmouth Hall
        </div></a></div>
        <div class="col-md-4"><img class="img-responsive mirrorimg" src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/01.23.15.Mirror.Collis_Natalie-Cantave-cropped.jpg" />
          <a href="<?php bloginfo('url');?>/2015/01/22/collis-center/"><div class="mirrorimgoverlay">
        Collis Center
        </div></a></div>
      </div>