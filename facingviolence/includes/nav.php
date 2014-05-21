<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid facing_violence_nav">

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
              <li class="active"><a href="/facingviolence">Home</a></li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">News Analysis<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <?php
                              $news = getCategory(1666,15);
                              foreach(array_slice($news,1) as $article) {
                                ?>

                                <li><a href="/facingviolence/article.php?id=<?=$article['id']?>"><?= $article['title']?></a></li>
                                <?
                              }
                              ?>
                        </ul>
                      </li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Features <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php
                              $features = getCategory(1664,15);
                              foreach(array_slice($features,1)  as $article) {
                                ?>

                                <li><a href="/facingviolence/article.php?id=<?=$article['id']?>"><?= $article['title']?></a></li>
                                <?
                              }
                              ?>
                        </ul>
              </li>
              <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opinion <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php
                              $opinions = getCategory(1669,15);
                              foreach(array_slice($opinions,1)  as $article) {
                                ?>

                                <li><a href="/facingviolence/article.php?id=<?=$article['id']?>"><?= $article['title']?></a></li>
                                <?
                              }
                              ?>
                        </ul>
              </li>

          </ul>
        <!-- .nav, .navbar-search, .navbar-form, etc -->
      </div>

    </div>
  </div>
</div>
