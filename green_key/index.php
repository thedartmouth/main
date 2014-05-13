<<?php ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="blitz" content="mu-888cf5c6-e0ed7357-64cc0734-6f33dfe6"/>
  <title>The Dartmouth - Green Key Special</title>
  <?php include("../includes/htmlhead.php");

    include("../included.php"); ?>

<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
 
      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
      <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="brand" href="#"><img src="/logo.png"/></a>
 
      <!-- Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse collapse">
          <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">News Analysis<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <?php
                              $news = getCategory(4,5);
                              foreach($news as $article) {
                                ?>

                                <li><a href="/article.php?id=<?=article['id']?>"><?= $article['title']?></a></li>
                                <?
                              } 
                              ?>
                        </ul>
                      </li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Features <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        </ul>
              </li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opinion <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        </ul>
              </li>

          </ul>
        <!-- .nav, .navbar-search, .navbar-form, etc -->
      </div>
 
    </div>
  </div>
</div>