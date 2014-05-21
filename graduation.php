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

                    $("#step1").addClass('hide');
                    $("#step2").removeClass('hide');
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
                            1. Save your message
                        </span>
                        <span id="step2-header" class="grey pull-right">
                            2. Submit photo and payment
                        </span>
                    </h3>
                    <div id="step1">
                        <form name="ad-details" id="adForm" class="form-horizontal" action="send_grad_ad.php" method="post" enctype="multipart/form-data">
                            <legend></legend>
                            <div class="control-group">
                                <label class="control-label" for="billingName">Your Name</label>
                                <div class="controls">
                                    <input type="text" id="billingName" name="billingName" placeholder="Your Name" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="billingEmail">Your Email</label>
                                <div class="controls">
                                    <input type="text" id="billingEmail" name="billingEmail" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="studentName">Student Name</label>
                                <div class="controls">
                                    <input type="text" id="studentName" name="studentName" placeholder="Student Name" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="message">Message (35-40 words)<br><span id="remaining">40</span> words remaining</label>
                                <div class="controls">
                                    <textarea rows="3" id="message" name="message" placeholder="Enter message here." required></textarea>
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

                    </div>
                    <h5>
                        If you have any questions or requests, please contact <a href="mailto:graduation@thedartmouth.com">graduation@thedartmouth.com</a>
                    </h5>
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
