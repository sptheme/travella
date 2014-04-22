<?php global $smof_data; ?>	

	<footer id="footer">
	<div class="footer-widgets">
		<div class="container clearfix">
			<div class="widget sp-widget-navigation">
				<div class="widget-title">
					<h3>Additional Information</h3>
				</div>
				<ul>
					<li><a href="#">About us</a></li>
					<li><a href="#">Contact us</a></li>
					<li><a href="#">FAQs us</a></li>
					<li><a href="#">Reservaion</a></li>
					<li><a href="#">Payment options</a></li>
					<li><a href="#">Travel tips</a></li>
				</ul>
				<form class="subscriber">
					<label for="mail_subscriber">Sign up to receive Special Offers:</label>
					<input type="text" class="mail-subscriber" name="mail_subscriber" onfocus="if (this.value == 'Enter your email…') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Enter your email…';}" value="Enter your email…">
					<input type="submit" value="Subscribe Now" class="btn-subscriber">
				</form>
			</div> <!-- .widget sp-widget-navigation -->

			<div class="widget sp-widget-quickcall">
				<div class="widget-title">
					<h3>Quick Call</h3>
				</div>
				<p class="call-number">(855) 12 608 108</p>
				<p>Call 24 hours a day, 7 days a week!</p>

				<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
				<div id="SkypeButton_Call_bonnyseng_1">
				  <script type="text/javascript">
				    Skype.ui({
				      "name": "call",
				      "element": "SkypeButton_Call_bonnyseng_1",
				      "participants": ["bonnyseng"],
				      "imageColor": "white",
				      "imageSize": 32
				    });
				  </script>
				</div>
				<div class="payment-cards">
					<img src="<?php echo SP_ASSETS_THEME; ?>images/payment-card/visacard.png">
					<img src="<?php echo SP_ASSETS_THEME; ?>images/payment-card/discover.png">
					<img src="<?php echo SP_ASSETS_THEME; ?>images/payment-card/bank-transfer.png">
					<img src="<?php echo SP_ASSETS_THEME; ?>images/payment-card/paypal.png">
					<img src="<?php echo SP_ASSETS_THEME; ?>images/payment-card/american-express.png">
					<img src="<?php echo SP_ASSETS_THEME; ?>images/payment-card/mastercard.png">
				</div> <!-- .payment-cards -->
			</div> <!-- .widget sp-widget-quickcall -->
			<div class="widget sp-widget-address">
				<div class="widget-title">
					<h3>Offices address:</h3>
				</div>
				<h5>Phnom Penh <a href="#">View map</a></h5>
				<p>#AC04, Street 55, Borei Sopheak Mongkul, Chroy Changva, Cambodia</p>
				<p>Tel: +855 23 426-456</p>
				<h5>Siem Reap <a href="#">View map</a></h5>
				<p>No. 28, Road 06, Svay Dangkum, Siem Reap Province, Cambodia</p>
				<p>Tel: +855 23 426-456</p>
			</div> <!-- .widget sp-widget-address -->	
		</div> <!-- .container .clearfix -->
	</div> <!-- .footer-widgets -->
	<div class="awards">
    	<a target="_blank" title="Ministry of Tourism" href="http://www.mot.gov.kh"><img alt="Ministry of Tourism" src="<?php echo SP_ASSETS_THEME; ?>images/awards/mot.jpg"></a>
        <a target="_blank" title="Member of PATA" href="http://www.pata.org/Members/7235"><img alt="Member of PATA" src="<?php echo SP_ASSETS_THEME; ?>images/awards/pata-member.jpg"></a>
        <img alt="Cambodia of Wonder" src="<?php echo SP_ASSETS_THEME; ?>images/awards/cambodia-wonder.jpg">
        <a target="_blank" title="CATA - Cambodia Association of Travel Agents" href="http://www.catacambodia.com"><img alt="C.A.T.A" src="<?php echo SP_ASSETS_THEME; ?>images/awards/c.a.t.a.jpg"></a>
        <a target="_blank" title="CLEAN CITY DAY &ndash; LET'S DO IT! CAMBODIA" href="http://www.cambodialetsdoit.org"><img alt="Let Do It" src="<?php echo SP_ASSETS_THEME; ?>images/awards/letdoitcambodia.jpg"></a>
        <a target="_blank" title="Cambodia Community-Base Ecotourism Newtwork" href="http://www.ccben.org/"><img alt="ccben" src="<?php echo SP_ASSETS_THEME; ?>images/awards/ccben-logo.jpg"></a>
    </div> <!-- .awards -->
	<nav class="footer-nav">
		<div class="container">
		<?php echo sp_footer_navigation(); ?>
		<p class="copyright"><?php echo $smof_data['footer_text']; ?></p>
		</div> <!-- .container -->
	</nav> <!-- #footer-nav -->	
	</footer><!-- #footer -->

</div> <!-- #wrapper -->

<?php wp_footer(); ?>
	
</body>
</html>