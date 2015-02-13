<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

  <style>
  .backbutton {
    top: 0;
    left: 0;
    opacity: 0.4;
    z-index: 0;
    height: 50px;
  }
  .backbutton:hover {
    opacity: 1;
    cursor: pointer;
  }
  .backbutton a {
    color: black;
    font-weight: bold;
  }
  .backbutton img {
    width: 80px;
    margin-right: -10px;
    vertical-align:middle;
  }
  .intro {
  	color: black;
  	text-align: center;
  	margin-left: 20%;
  	margin-right: 20%;
  	font-family: georgia;
  }
  .intro h1 {
  	padding: 40px;
  }
  .intro p {
  	font-size: 1.4em;
  	padding-bottom: 20px;
  }
  .sentence {
width:800px;
padding:10px;
height:500px;
position:fixed;
margin-top:-250px;
margin-left:-400px;
top:50%;
left:50%;
display: none;
text-align: center;
font-size: 4vw;
color: purple;
font-family:helvetica, sans-serif;
}



  }
  </style>
  <a href="<?php bloginfo('url');?>"><div class="backbutton">
   <img src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/d_isolated.png">
   <span style="color: black;">Back to <b>The Dartmouth</b></span>
</div></a>
	<div class="intro">
      <h1>Here's what Dartmouth students said...</h1>
      <p>When <em>The Mirror</em> polled campus last week, we asked, <br><br>
<em>If you could send an anonymous romance-related message to anyone at Dartmouth, what would you say?</em><br><br>
Here's how you responded. </p>
	<button type="button" class="btn btn-success btn-lg" onclick="startDisplay()">Start</button>
    </div>
    <div class="sentence" id="sentenceText">
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    function shuffle(array) {
      for (var i = array.length - 1; i > 0; i--) {
          var j = Math.floor(Math.random() * (i + 1));
          var temp = array[i];
          array[i] = array[j];
          array[j] = temp;
      }
      return array;
    }
    var sentences = ["You are what I think about in that place between asleep and awake.","You make me smile.","No.","I’ve always loved you — knowing that you don’t reciprocate doesn’t change how I feel about you, and I’m sorry to have caused you so much worry and concern.","Yes, it was your pong skills that wooed me.","Don’t get your hopes up. ","I’m a sweet dude.","I like you. Isn’t it obvious already?! ","Have more sex.","Hi, let’s get some KAF, and watch a movie and not have sex ’til we’re actually comfortable with each other and know we both like each other.","Don’t put all your eggs in one basket. Don’t let a relationship define your Dartmouth experience. ","Don’t get attached!","I’m sorry that Hanover is so boring.","I wish I had met you sooner.","I love you!","Hey, sup?","Would you take me out somewhere I could wear a beautiful dress, make me laugh, walk me to me doorstep, kiss me goodnight and call me in the morning?","Don’t be a rapist please.","I like your septum.","We should do this more often. ","You have a beautiful smile.","Why can’t you see you belong with me.","I still haven’t done any of the Dartmouth seven... can you help me out with that?","NOT WORTH THE PAIN.","I think you’re cute and amazing and would love to get to know you better.","I don’t see the point of anonymous romantic messages. If you’re going to take the plunge and tell someone you’re interested, you might as well go all in.","Do you.","There should be two people in each relationship, no more and no less.","I kinda dig you. ","Don’t be afraid to commit. ","Do not take me out to dinner just because you think it’s the \“right\” thing to do.","I’ve got a blank space baby, and I’ll write your name. ","We make more sense together than we do apart. So let’s take a chance on us.","Roommate, please find another place to have (really loud) sex other than our dorm room. ","Come back from your LSA already. I miss you.","No clue.",";)","Anyone? No, anything I would say would be too obvious, no thanks. ","I have nothing to say to anyone.","Even though we’ve never dated, I think we’d be a great married couple.","I feel incredibly cheesy writing you a love message, but honestly being in love with you has been one of my greatest accomplishments at Dartmouth. ","I’m willing to try if you are.","Remember that there is far more to life than romance. Don’t let romance, or the lack of it, dominate your life.","If you like someone, go for it in the right way — do things right, and don’t let your friends influence you not to.","I would tell them that we’re all imperfect creatures looking for someone to be there for us.","Pong tonight?","We would be so great together. Why don’t you notice me?","Don’t text me drunk telling me to come over — ask me on a real date. ","We only just started spending more time together, but in you I finally see I person that I don’t have to justify a relationship with. It’s just natural — I’m not worried or rushed, but I’m confident that we could be something.","Please just tell me if you like me or not. Be direct. ","If you’re tired of being single, ask them to lunch, not pong!","When I’m with you it feels natural and good, and these are the first real feelings I’ve had since high school. ","I loved you once. ","Love come in so many forms, each as beautiful as the rest. Love for a sister, a friend or a parent is no weaker than that for a significant other. ","Casual hookups are meaningless and are definitely not romantic — try actual dating and chivalry instead for a meaningful relationship.","Don’t let what you think the dominant hookup culture is define what your love life is for you. Take risks!","You are wonderful.","I hope you someday realize what is truly important in life.","Semi?","I want to make this work!","What makes someone a “relationship person?”","Let’s just call it a relationship already.","Don’t be scared to initiate hanging out sober.","You are beautiful, but I’m very happy with the one I’m with.","What are we??","I can’t read you at all!! Are you interested or not?!?! Why won’t you talk to me?","Thank you for constantly pushing me to grow and for remaining my best friend in the midst of our romance.","I wish you knew.","Bring flitzing back.","You complete me. ","Love doesn’t last. Make the most of it while it’s there.","Lunch? ","I think you’re swell, and I’m really glad I met you.","Go along with the flow but don’t be averse to a chance at a relationship!","You’re so cute.","Let’s go on an actual date.","I’m avoiding you at FoCo.","People are fragile creatures. Embrace them, and don’t play with their emotions.","Need one for pong.","I’m happy we both want to wait until marriage.","To a guy who graduated, I hope you’re a better person in the real world.","Hi.","Communicate. More than anything, I just wanted to know what you were thinking. ","I wish I could tell you that I liked you, but I don’t want to ruin our friendship.","Love is everywhere.","Live every night like it’s last chance dance. ","Are you thoughts as hot as your body?","I wish you would tell me you loved me when you were sober.","I hope there’s a chance for us some day.","If only you were taller.","Are you a beaver, cause DAAAAM.","Somebody loves you.","Screw you dude who I made out with at Beta that one time and then never texted me again.","I wonder how things would have turned out.","You’re an amazing human being, but you have a lot of growing up to do. Hope you get there sooner rather than later.","Sup bae?","I have no idea.","You’re my best friend.","Are you ready?","I think about texting you a lot when I’m drunk. I don’t know what that means.","We’d have really attractive kids — do me?","I never knew what \“out of my league\” meant until I met you.","I hate you for wasting so much of my time","*Kissy face emoji*","The reason we lost touch was that being around you and knowing you weren’t ready was too hard to bear.","You left your Facebook logged in on my computer after we broke up. I felt bad for reading your messages until I saw what you said about me. I’ve never been more hurt by someone in my life.","It’s good that you’re different from everyone else."];
    shuffle(sentences);
    console.log(sentences);
    var colors = ["#9C1C6B","#CA278C","#E47297","#AA0114","purple","pink","#DD0000"];
    var counter = 0;
    function startDisplay() {
    	$('.intro').fadeOut();
    	$('.sentence').fadeIn();
    	$('#sentenceText').text(sentences[counter]);
    	counter++;
    	var timer = window.setInterval(runDisplay,3500);
    }
    function runDisplay() {
    	//window.alert("Running");
		$('#sentenceText').text(sentences[counter]);
		var index = Math.floor(Math.random() * (colors.length + 1));
		$('#sentenceText').css("color",colors[index]);
		$('.sentence').hide();
		$('.sentence').fadeIn();
		if (counter == sentences.length - 1) {
			counter = 0;
		} else {
			counter++;
		}
    }
    </script>