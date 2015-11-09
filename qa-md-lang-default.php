<?php
/*
	Question2Answer Edit History plugin
	License: http://www.gnu.org/licenses/gpl.html
*/

return array(
	'plugin_title' => 'Markdown',
	'preview' => 'Preview',

	'admin_hidecss' => 'Don\'t add CSS inline',
	'admin_hidecss_note' => 'Tick if you added the CSS to your own stylesheet (more efficient).',
	'admin_comments' => 'Plaintext comments',
	'admin_comments_note' => 'Sets a post as plaintext when converting answers to comments.',
	'admin_syntax' => 'Use syntax highlighting',
	'admin_syntax_note' => 'Integrates highlight.js for code blocks.',

	/* Button texts */

	'button_bold' => 'Bold text',
	'button_italic' => 'Italic text',
	'button_url' => 'Add link',
	'button_image' => 'Add link to image',
	'button_quote' => 'Block quote',
	'button_upload' => 'Upload image',
	'button_help' => 'Short Markdown syntax help',
	'cancel' => 'Cancel',

	/* Editor inserted text */

	'bold' => 'bold text',
	'italic' => 'italic text',
	'quote' => 'quote',
	'url' => 'url',
	'img' => 'url',
	'img_description' => 'description',
	'upload' => 'Choose file to upload:',
	'upload_header' => 'Upload an image',


	/* Markdown help page */

	'help_title' => 'Short overview of Markdown syntax',
	'help_text' => <<<EOT
		<p>
		Markdown is a lightweight and easy-to-use syntax for styling web content
		that is getting more and more popular across the internet.
		</p>
		<p>
		You control the display of the document; formatting words as bold or italic,
		adding images, and creating lists are just a few of the things we can do with
		Markdown. Mostly, Markdown is just regular text with a few non-alphabetic characters
		thrown in, like <code>#</code> or <code>*</code>.
		</p>

		<h2>Basic text formatting</h2>

		<p>New paragraphs are started by leaving a blank line in the input.</p>

		<p>It is easy to make words **bold** or *italic*.
		</p>

		<p>Headings are written as
		<ul>
		<li># Main heading</li>
		<li>## Secondary heading</li>
		<li>...</li>
		<li>###### All the way down to a very minor heading</li>
		</ul>
		</p>

		<h2>Lists</h2>

		<p>Numbered lists can be written simply as</p>
		<p>
		1. First item <br />
		2. Second item <br />
		3. And so on
		</p>

		<p>Lists without numbers (bullet point lists) are</p>
		<p>
		* written <br />
		* like <br />
		* this
		</p>

		<p>Dashes work just as well as stars, and lists can be nested. Just indent each sublist by two spaces</p>
		<p>
		1. First item<br />
		&nbsp;&nbsp;- with subtiems<br />
		&nbsp;&nbsp;- like these<br />
		2. Back to the main list<br />
		3. For a while<br />
		&nbsp;&nbsp;* sublist<br />
		&nbsp;&nbsp;&nbsp;&nbsp;* subsublist<br />
		</p>

		<h2>Links and images</h2>

		<p>Links can be added using [this syntax](http://google.com), and images are
		added with almost the exact same syntax, just add a ! first:
		![description of the image](http://address.to.image/example.png)</p>
EOT

);
