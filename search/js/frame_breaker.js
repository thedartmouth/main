/**
 * Frame Breaker
 * Stops the site from being framed (put in an iframe) by a third party
 * 
 **/

<!--
	if (top.location!= self.location) {
		top.location = self.location.href
	}
//-->