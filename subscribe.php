<?php

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
     The Dartmouth - Subscribe
    </title>
    <?php include("includes/htmlhead.php");

                include("included.php"); ?>
    </head>

<body>

    <!-- navs -->
    <?php include("includes/navs.php"); ?>

<div class="content container-fluid">
    <div class="row-fluid">
        <div class="span4" id="subscribe-form">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="HEVTLRFQT3KR6">
            <table>
            <tr><td><input type="hidden" name="on0" value="Subscription Options">Subscription Options</td></tr><tr><td><select name="os0">
                        <option value="One Term">One Term $59.00 USD</option>
                        <option value="One Year">One Year $149.00 USD</option>
                        <option value="Four Year">Four Year $499.00 USD</option>
            </select> </td></tr>
            </table>
            <input type="hidden" name="currency_code" value="USD">
            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>

        <div class="span8">
            <h1 class="text-center">Don't miss out!</h1>
            <h3 class="text-center">Subscribe today and have <i>The Dartmouth</i> delivered to your doorstep.</h3>
            <br>
            Let The D be your guide to everything that happens at the College, the Upper Valley and the rest of the world.<br><br>
            Every day, we cover events that matter. From alumni politics to speeches by presidential candidates, you&#39ll be on top of the news. The Dartmouth also offers student profiles and news analyses of major news stories, on- and off-campus.<br><br>
            In addition to keeping you on top of what is going on at the College, The Dartmouth can help those living in the Hanover area decide what to do to relax on weekends. The D provides listings and reviews of activities, concerts, festivals, shows and sports events across the Upper Valley.
            You will also enjoy our special weekly inserts. The Dartmoth Mirror (Fridays) is your portal to Dartmouth student culture, while the Sports Weekly magazine (Mondays) provides comprehensive coverage of all the action on the playing field.<br><br>
            A one term subscription costs $59. Subscribe for a year and pay only $149, and for four years only $499.<br><br>
            Have questions? Please call us at (603) 646-2600, or send us an email at <a href="mailto:business@thedartmouth.com">business@thedartmouth.com</a>.
        </div>
    </div>
<div>

    <!--footer-->
        <div class="row">
            <div id="footer">

                <?php include("includes/footer.php"); ?></div>
        </div>
</body>
</html>
