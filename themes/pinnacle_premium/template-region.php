<?php
/*
Template Name: Region
*/
?>
<?php get_header(); ?>
	<?php get_template_part('templates/page', 'header'); ?>
	
    <div id="content" class="container">
   	<div class="row">
    <div class="main <?php echo kadence_main_class(); ?>" role="main">
    	<div class="postclass pageclass clearfix entry-content" itemprop="mainContentOfPage">
			<?php get_template_part('templates/content', 'page'); ?>
		</div>

		<div class="[ row ][ margin-bottom ]">
			<div class="[ tcol-xs-12 tcol-sm-7 ][ content-regions-right ]">
				<ul class="[ list-highlights list-dot ][ block-highlight ]">
					<h4>Highlights</h4>
					<li>The first African Open Data Conference was hosted in Dar Es Salaam in 2015.</li>
					<li>21 African countries are part of the Open Data Barometer open data rankings.</li>
				</ul>
				<p>While open data work in Africa began in 2011, the region only started to truly gain momentum in 2015. Since that time, Open Data for Development (OD4D) has been working to foster the open data community and emerging open data leaders, to spur further action. Some of the key initiatives OD4D is supporting in in Africa include:</p>
				<strong>Africa Data Revolution Report</strong>
				<p>The Africa Data Revolution Report includes in-depth case studies of 10 African countries to better understand their national data ecosystems and political and legal frameworks. Current countries in the report include: Madagascar, Kenya, Ethiopia, Rwanda, Tanzania, Cote d'Ivoire, Senegal, Swaziland, Nigeria, South Africa. This work is carried out with the support of our partner the World Wide Web Foundation (WF).</p>
				<a href=""> Learn More… </a>	
				<strong>Africa Data Revolution Report</strong>
				<p>The Africa Data Revolution Report includes in-depth case studies of 10 African countries to better understand their national data ecosystems and political and legal frameworks. Current countries in the report include: Madagascar, Kenya, Ethiopia, Rwanda, Tanzania, Cote d'Ivoire, Senegal, Swaziland, Nigeria, South Africa. This work is carried out with the support of our partner the World Wide Web Foundation (WF).</p>
				<a href=""> Learn More… </a>	
			</div>
			<div class="[ tcol-xs-12 tcol-sm-5 ][ content-regions-left ]">
				<h2>Africa Open Data Network</h2>
				<p><strong> Hosted at:</strong> Local Development Research Institute (LDRI) in Nairobi, Kenya </p>
				<p><strong>Launched:</strong> Early 2017</p>
				<p>Open Data for Development’s (OD4D) work in Africa is coordinated by the Africa Open Data Network (AODN). This hub aims to scale the development impact of open data initiatives in Africa through promoting the adoption of improved open data principles, best practices, policies, partnerships, and use. The AODN will be supported with additional capacity building and innovation-oriented activities, building on existing OD4D work in Africa, including efforts led by Open Knowledge International (OKI) and the Open Data Institute (ODI).
				</p>
				<a href="">Learn more about the AODN:</a>			
			</div>
		</div>


		<div id="map" class="[ projects-map ][ margin-bottom ]" style="height: 350px"></div>


		<?php do_action('kt_after_pagecontent'); ?>



</div><!-- /.main -->
  <?php get_footer(); ?>