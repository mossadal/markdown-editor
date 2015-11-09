<?php
/*
	Question2Answer Markdown editor plugin
	License: http://www.gnu.org/licenses/gpl.html
*/

class qa_html_theme_layer extends qa_html_theme_base
{
	public function head_custom()
	{

		parent::head_custom();

		$tmpl = array('ask', 'question');
		if (!in_array($this->template, $tmpl))
			return;

		$this->output_raw("</style>\n\n");
		$this->output_raw('<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">');
		$this->output_raw('<link rel="stylesheet" href="'.QA_HTML_THEME_LAYER_URLTOROOT.'md.css">');
		$this->output_raw('<script src="'.QA_HTML_THEME_LAYER_URLTOROOT.'jquery-selection.js"></script>');
		$this->output_raw('<script src="'.QA_HTML_THEME_LAYER_URLTOROOT.'markdown-editor.js"></script>');


	}
}
