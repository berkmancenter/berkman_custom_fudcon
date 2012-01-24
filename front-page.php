<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="front-content" role="main" class="clearfix">
                <section id="about" class="one column">
                    <header>
                        <h1><a href="about/">About</a></h1>
                    </header>
                    <!-- <a href="about/" class="more-page">More information &raquo;</a> -->
                </section>
                <section id="updates" class="two column">
                    <header>
                        <h1><a href="blog/">Recent Updates</a></h1>
                    </header>
                    <!-- <a href="blog/" class="more-page">Full blog &raquo;</a> -->
                </section>
                <section id="participants" class="two column">
                    <header>
                        <h1><a href="participants/">Framing</a></h1>
                    </header>
                    <ul></ul>
                    <!-- <a href="participants/" class="more-page">All participants &raquo;</a> -->
                </section>
                <section id="agenda" class="one column">
                    <header>
                        <h1><a href="agenda/">Social</a></h1>
                    </header>
                    <!-- <a href="agenda/" class="more-page">Full agenda &raquo;</a> -->
                </section>
                <!-- <section id="twitter" class="one column">
                    <header>
                        <h1><a href="twitter.com">Twitter</a></h1>
                    </header>
                    <ul id="tweets">
                        <li class="tweet">This is a tweet about #truthiness.</li>
                        <li class="tweet">This is another tweet about #truthiness.</li>
                        <li class="tweet">This is yet another tweet about #truthiness.</li>
                    </ul>
                </section> -->
			</div>
		</div>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
