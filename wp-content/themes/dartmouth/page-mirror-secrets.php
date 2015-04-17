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
font-family:helvetica, sans-serif;
}



  }
  </style>
  <a href="<?php bloginfo('url');?>"><div class="backbutton">
   <img src="<?php bloginfo('url');?>/wp-content/uploads/2015/01/d_isolated.png">
   <span style="color: black;">Back to <b>The Dartmouth</b></span>
</div></a>
	<div class="intro">
      <h1>Shh... Tell Us a Secret​</h1>
      <p>We asked students across campus to tell us secrets, hopes and fears.<br><br>
Here’s what you said.</p>
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
    var sentences = ["Sometimes I miss people who have been jerks to me, even though I know I should forget about them.","I have the hugest crush on a friend. He has no idea... or maybe he does. ","My high school boyfriend threatened to commit suicide while we were dating. Sometimes I still have nightmares about it.","My girlfriend and I had sex in the stacks, and we were so loud that a janitor called S&S on us. We escaped before they got us, though.","I sometimes feel like I don’t belong at Dartmouth.","I’m falling for my boyfriend’s little.","My trip leader taught me how to deep throat.","I cried everyday when I was off last winter.","I want to get married more than anything. ","I can’t stand to be around my best friend anymore.","I’m working on my debut solo tape, expected release date will be early summer.","When I was 13, I drowned my sister’s cat in a bucket. I didn’t hate the cat or anything — I was just wanted see what would happen. No one ever found out.","I’m really excited to graduate, not because I dislike Dartmouth, but because I’m ready for some new people and my own dish set.","I killed the class hamster by feeding it too many sunflower seeds.","I’m secretly angry at my sister for being bulimic, not for what she has done to herself, but because I want to purge every day but can’t talk to my family because of the pain she has caused them.","I had a threesome with my best friend and my ex. ","I’m a senior, and I’m still a virgin and I’ve never been kissed.","Sometimes I change where I’m studying with the hopes of seeing my crush.","I’m crushing hard on a teammate right now.","I can’t stand to be around my best friend anymore.","I don’t know how to love myself, which makes it hard for me to express respect and love for others. It’s ruining my friendships.","I don’t feel comfortable in my fraternity.","People think I’m honest to a fault, but I’m actually a pathological liar. I never lie about serious things, but I’ll lie about the origin of a story to make it more exciting. Never been caught.","I had sex in the stacks today.","Every day I wish I could step out of my skin and be anyone but myself.","I’m crazy into my roommate who doesn’t even know I’m gay ­­­— I sometimes sneak glimpses when she’s changing and always feel guilty afterwards. ","All my friends hate their majors.","I’m hooking up with my UGA.","I got an abortion last summer.","I use my emotional issues to guilt people into caring about me.","I don’t think I have any secrets, and sometimes I worry this means I’m repressing some really terrible, traumatic memories.","I hate my body. ","I tried to kill myself freshman year, but all my friends just thought I was just blacked out as usual.","I’ve had a crush on my best friend since the day we met six years ago.","I’ve made out with a professor (economics!).","I’ve never kissed someone sober.","I haven’t worn deodorant the past four days because I’m too lazy to go to CVS.​"];
    shuffle(sentences);
    console.log(sentences);
    // var colors = ["#9C1C6B","#CA278C","#E47297","#AA0114","purple","pink","#DD0000"];
    var counter = 0;
    function startDisplay() {
    	$('.intro').fadeOut();
    	$('.sentence').fadeIn();
    	$('#sentenceText').text(sentences[counter]);
    	counter++;
    	var timer = window.setInterval(runDisplay,4000);
    }
    function runDisplay() {
    	//window.alert("Running");
		$('#sentenceText').text(sentences[counter]);
		// var index = Math.floor(Math.random() * (colors.length + 1));
		// $('#sentenceText').css("color",colors[index]);
		$('.sentence').hide();
		$('.sentence').fadeIn();
		if (counter == sentences.length - 1) {
			counter = 0;
		} else {
			counter++;
		}
    }
    </script>