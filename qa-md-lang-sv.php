<?php
/*
	Question2Answer Edit History plugin
	License: http://www.gnu.org/licenses/gpl.html
*/

return array(
	'plugin_title' => 'Markdown',
	'preview' => 'Förhandsgranskning',

	'admin_hidecss' => 'Don\'t add CSS inline',
	'admin_hidecss_note' => 'Tick if you added the CSS to your own stylesheet (more efficient).',
	'admin_comments' => 'Plaintext comments',
	'admin_comments_note' => 'Sets a post as plaintext when converting answers to comments.',
	'admin_syntax' => 'Use syntax highlighting',
	'admin_syntax_note' => 'Integrates highlight.js for code blocks.',

	/* Button texts */

	'button_bold' => 'Fet text',
	'button_italic' => 'Kursiv text',
	'button_url' => 'Lägg till länk',
	'button_image' => 'Lägg till länk till bild',
	'button_quote' => 'Citat',
	'button_upload' => 'Ladda upp bild',
	'button_help' => 'Kortfattad Markdown-hjälp',

	/* Markdown help page */

	'help_title' => 'Kortfattad beskrivning av Markdown syntax',
	'help_text' => <<<EOT
		<p>
		Markdown är en effektiv och lättanvänd metod för att formattera
		text på webben.
		</p>
		<p>
		Du kan kontrollera hur texten ser ut, använd fetstil och kursiv text, lägga
		till bilder, länkar, listor och mycket annat. Markdown är nästan helt baserat
		på vanlig text, med ett par specailsymboler som <code>#</code> och <code>*</code>.
		</p>

		<h2>Grundläggande formattering</h2>

		<p>Nya stycken skapas genom att lägga till en blankrad i texten.</p>

		<p>**Fet stil** och *kursiv* text är enkelt.</p>

		<p>Rubriker skrivs som
		<ul>
		<li># Huvudrubrik</li>
		<li>## Underrubrik</li>
		<li>...</li>
		<li>###### Hela vägen ner till en mycket diskret rubrik</li>
		</ul>
		</p>

		<h2>Listor</h2>

		<p>Numrerade listor skrivs enkelt som</p>
		<p>
		1. För det första <br />
		2. För det andra <br />
		3. Och så vidare
		</p>

		<p>Onumrerade listor:</p>
		<p>
		* skrivs <br />
		* så <br />
		* här
		</p>

		<p>Bindestreck fungerar lika bra som stjäror, och listor kan nästs. Använd två mellanslag för nästa nivå:</p>
		<p>
		1. Första punkten<br />
		&nbsp;&nbsp;- med en egen lista<br />
		&nbsp;&nbsp;- så här<br />
		2. Åter till huvudlistan<br />
		3. Igen<br />
		&nbsp;&nbsp;* underlista<br />
		&nbsp;&nbsp;&nbsp;&nbsp;* underunderlista<br />
		</p>

		<h2>Länkar och bilder</h2>

		<p>Länkar skrivs [så här](http://google.com), och bilder
		ser nästan likadana ut, lägg bara till ett ! i början:
		![beskrivning](http://address.till.bild/exempel.png)</p>
EOT

);
