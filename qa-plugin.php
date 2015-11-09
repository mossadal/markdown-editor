<?php
/*
	Plugin Name: Markdown Editor
	Plugin URI: https://github.com/mossadak/q2a-markdown-editor
	Plugin Description: Markdown editor plugin with MathJax support for simple text-based markup
	Plugin Version: 1.0
	Plugin Date: 2015-07-30
	Plugin Author: Frank Wikström
	Plugin Author URI: http://mossadal.se/
	Plugin License: GPLv3
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Minimum PHP Version: 5.2
	Plugin Update Check URI: https://raw.githubusercontent.com/svivian/q2a-markdown-editor/master/qa-plugin.php

	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

	More about this license: http://www.gnu.org/licenses/gpl.html
*/

if (!defined('QA_VERSION')) exit;


qa_register_plugin_module('editor', 'qa-markdown-editor.php', 'qa_markdown_editor', 'Markdown Editor');
qa_register_plugin_module('viewer', 'qa-markdown-viewer.php', 'qa_markdown_viewer', 'Markdown Viewer');
qa_register_plugin_layer('qa-md-layer.php', 'Markdown Editor layer');

qa_register_plugin_module('page', 'qa-md-ajax.php', 'qa_markdown_ajax', 'Markdown Editor AJAX handler');
qa_register_plugin_module('page', 'qa-markdown-upload.php', 'qa_markdown_upload', 'Markdown Editor Upload');
qa_register_plugin_module('page', 'qa-markdown-help.php', 'qa_markdown_help', 'Markdown Editor Help');

qa_register_plugin_phrases('qa-md-lang-*.php', 'markdown');
