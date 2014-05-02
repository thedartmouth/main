<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>The Dartmouth - Commemorate your student's graduation!</title>
    <?php include("includes/htmlhead.php");?>
    <script src="http://malsup.github.com/jquery.form.js"></script>

    <script>
        // wait for the DOM to be loaded
        $(document).ready(function() {
            // bind 'myForm' and provide a simple callback function
            $("#adForm").ajaxForm({
                target: '#step2',
                beforeSubmit: function () {
                    document.getElementById("formSubmit").value = "Loading...";
                },
                success: function()
                {
                    $("#step1-header").addClass("grey");
                    $("#step2-header").removeClass("grey");

                    $("#step1").addClass("hide");
                    $("#step2").removeClass("hide");
                }
            });
        });
    </script>

  </head>

  <body>

        <!-- navs -->
        <?php include("includes/navs.php"); ?>

        <!--content-->
        <div class="content container-fluid">
            <div class="row-fluid">
                <h1 class="text-center" id="grad-ad-header">Commemorate your student's graduation<br>with a spot in <em>The Dartmouth</em>!</h1>
                <div class="span3">
                </div>
                <div class="span6" id="grad-form">
                    <h3 id="step1-header">
                        <span id="step1-header" class="pull-left">
                            1. Send us your message
                        </span>
                        <span id="step2-header" class="grey pull-right">
                            2. Submit payment
                        </span>
                    </h3>
                    <div id="step1">
                        <form name="ad-details" id="adForm" class="form-horizontal" action="send_grad_ad.php" method="post" enctype="multipart/form-data">
                            <legend></legend>
                            <div class="control-group">
                                <label class="control-label" for="billingName">Your Name</label>
                                <div class="controls">
                                    <input type="text" id="billingName" name="billingName" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="billingEmail">Your Email</label>
                                <div class="controls">
                                    <input type="text" id="billingEmail" name="billingEmail" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="studentName">Student Name</label>
                                <div class="controls">
                                    <input type="text" id="studentName" name="studentName" placeholder="Student Name">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="message">Message (35-40 words)<br><span id="remaining">40</span> words remaining</label>
                                <div class="controls">
                                    <textarea rows="3" id="message" name="message" placeholder="Enter message here."></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="image">Attach an Image</label>
                                <div class="controls">
                                    <input type="file" id="image" name="image" accept="image/jpg">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input id="formSubmit"  type="submit" class="btn" name="submit" value="Next">
                                </div>
                            </div>
                        </form>
                        <div id="loading" class="hide">Please wait...</div>
                    </div>
                    <div id="step2" class="hide text-center">
                        <h3>Your ad has been submitted, but we must receive payment to publish.<h3>
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="BCEG5U8597FSG">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    </div>
                </div>
                <div class="span3">
                </div>
            </div>
        </div>

        <!--footer-->
        <div class="row-fluid">
            <div id="footer">
                <?php include("includes/footer.php"); ?>
            </div>
        </div>

  </body>
</html>


<script type="text/javascript">

    document.getElementById("message").onkeyup = function() {
        var shortened_text = this.value.replace(/(^\s+|\s+$)/g,'').split(" ").slice(0, 40);
        var remaining_count = 40 - shortened_text.length;

        document.getElementById("remaining").innerHTML = remaining_count;

        if (remaining_count <= 0) {
            document.getElementById("message").value = shortened_text.join(" ");
        }
    }

</script>
