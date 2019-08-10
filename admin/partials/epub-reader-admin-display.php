<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/PhelanH/epub-reader/
 * @since      0.9.0
 *
 * @package    Epub_Reader
 * @subpackage Epub_Reader/admin/partials
 */
?>
<style>
dl.epub-reader-dl dt { font-weight:bold;font-size:1.1em;margin-left:0.5em;}
span.epub-reader-sc { font-weight: bold; font-style:italic; font-size: 1.1em; }
</style>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<h2>ePub Reader Shortcode</h2>
<script type='text/javascript' src='https://ko-fi.com/widgets/widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#46b798', 'N4N6ZM5U');kofiwidget2.draw();</script> 
<p>Die folgenden Attribute können im Shortcode <span class="epub-reader-sc">[epub-reader]</span> angegeben werden:</p>

<dl class='epub-reader-dl'>
	<dt>src</dt><dd>Der Standardwert ist 'epub /', was dem Pfad <em>http://&lt;wp-install-location&gt;/epub/</em> entspricht.Beachten Sie, dass der Pfad <em>immer</em> relativ zur WordPress-Installation ist. Vollständige URLs werden derzeit nicht unterstützt.</dd>
	<dt>version</dt><dd><em>Version</em> des Buches. <em>version="2-beta"</em>. <br/>
	Hinweis: Dies hat zur Folge, dass die individuelle Leseposition jedes Benutzers zurückgesetzt wird. Andernfalls wird das Leseerlebnis des Benutzers jedoch durch unerwartete Fehler beeinträchtigt, wenn die Änderungen umfangreich sind.</dd>
	<dt>width</dt><dd>Setzt die Breite des IFrames. z.B. <em>width="300px"</em>.</dd>
	<dt>height</dt><dd>Setzt die Höhe des IFrames. z.B <em>height="480px"</em>.</dd>
	<dt>style</dt><dd>Legen Sie einen beliebigen CSS-Stil für den IFrame direkt fest. z.B <em>style="min-height:480px"</em>.</dd>
	<dt>class</dt><dd>Legen Sie eine beliebige CSS-Klasse für den IFrame fest. z.B<em>class="some-ebook-class"</em>.</dd>
</dl>

<h3>Beispiele</h3>
<ol>
<li>[epub-reader src="uploads/Wuthering_Heights.epub"]. (Lädt das komprimierte Buch von <em>http://&lt;wp-install-location&gt;/uploads/Wuthering_Heights.epub</em>. Beachten Sie, dass dies sehr ineffizient ist!</em>)</li>
<li>[epub-reader src="epubs/Wuthering_Heights/"]. (Lädt aus einem entpackten epub <em> http://&lt;wp-install-location&gt;/epubs/Wuthering_Heights/</em>. Dies ist die effizienteste Methode.)</li>
</ol>

<div id="wrap">
	<form method="post" action="options.php">
		<?php
			/*
			see also: EPub_Reader_Admin:register_settings() to reinstate settings
			settings_fields( 'epub-reader-settings' );
			do_settings_sections( 'epub-reader-settings' );
			submit_button();
			*/
		?>
	</form>
</div>