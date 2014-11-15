<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid special_nav">

      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <!-- Be sure to leave the brand out there if you want it shown -->
      <a class="brand" href="/"><img src="/invertedlogo.png"/></a>

      <!-- Everything you want hidden at 940px or less, place within here -->
      <div class="nav-collapse collapse">
          <ul class="nav">
              <li class="home"><a href="/greek">Home</a></li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">News Analysis <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <?php
                              $news = getCategory(1672,15);
                              if ($news['feature']) {
                                unset($news['feature']);
                              }
                              foreach($news as $article) {
                                ?>

                                <li><a href="/greek/article.php?id=<?=$article['id']?>"><?= $article['title']?></a></li>
                                <?
                              }
                              ?>
                        </ul>
                      </li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Features <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php
                              $features = getCategory(1674,15);
                              if ($features['feature']) {
                                unset($features['feature']);
                              }

                              foreach($features  as $article) {
                                ?>

                                <li><a href="/greek/article.php?id=<?=$article['id']?>"><?= $article['title']?></a></li>
                                <?
                              }
                              ?>
                        </ul>
              </li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opinion <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php
                              $opinions = getCategory(1673,15);
                              if ($opinions['feature']) {
                                unset($opinions['feature']);
                              }

                              foreach($opinions  as $article) {
                                ?>

                                <li><a href="/greek/article.php?id=<?=$article['id']?>"><?= $article['title']?></a></li>
                                <?
                              }
                              ?>
                        </ul>
              </li>
              <li class="dropdown">
                        <a href="/greek/article.php?id=111010">Quick Takes</a>
              </li>

          </ul>
        <!-- .nav, .navbar-search, .navbar-form, etc -->
      </div>

    </div>
  </div>
</div>
