<?php global $smof_data; ?>	

	<footer id="footer">
	<?php get_sidebar('footer'); ?>	
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