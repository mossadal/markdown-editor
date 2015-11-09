<?php
/*
	Question2Answer Markdown editor plugin
	License: http://www.gnu.org/licenses/gpl.html
*/

require_once "Markdown.php";

class qa_markdown_editor
{
	private $pluginurl;
	private $cssopt = 'markdown_editor_css';
	private $convopt = 'markdown_comment';
	private $hljsopt = 'markdown_highlightjs';
	private $uploadopt = 'md_upload_images';

	public function load_module($directory, $urltoroot)
	{
		$this->pluginurl = $urltoroot;
	}

	public function calc_quality($content, $format)
	{
		return $format == 'markdown' ? 1.0 : 0.8;
	}

	public function get_field(&$qa_content, $content, $format, $fieldname, $rows, $autofocus)
	{
		$parser = new Markdown;
        $html = $parser->text($content);

        $sane_html = qa_sanitize_html($html, @$options['linksnewwindow']);

		$help_url = qa_path('markdown-help');

		$html = '<div id="md-button-bar-'.$fieldname.'" class="md-button-bar">'. "\n";
		$html .= '<span title="'.qa_lang_html('markdown/button_bold').'" class="md-button md-button-bold"><i class="fa fa-bold"></i></span>'. "\n";
		$html .= '<span title="'.qa_lang_html('markdown/button_italic').'" class="md-button md-button-italic"><i class="fa fa-italic"></i></span>'. "\n";
		$html .= '<span title="'.qa_lang_html('markdown/button_url').'" class="md-button md-button-url"><i class="fa fa-link"></i></span>'. "\n";
		$html .= '<span title="'.qa_lang_html('markdown/button_image').'" class="md-button md-button-img"><i class="fa fa-image"></i></span>'. "\n";
		$html .= '<span title="'.qa_lang_html('markdown/button_quote').'" class="md-button md-button-blockquote"><i class="fa fa-quote-right"></i></span>'. "\n";
		$html .= '<span title="'.qa_lang_html('markdown/button_upload').'" class="md-button md-button-upload"><i class="fa fa-upload"></i></span>'. "\n";
		$html .= '<span title="'.qa_lang_html('markdown/button_help').'" class="md-button md-button-help"><a href="'.$help_url.'" target="_blank"><i class="fa fa-question" id="md-button-help"></i></a></span>'. "\n";
		$html .= '</div>' . "\n";
		$html .= '</div>'. "\n";
		$html .= '<textarea name="'.$fieldname.'" id="wmd-input-'.$fieldname.'" class="md-preview-source" >'.$content.'</textarea>' . "\n";
		$html .= '<h3>'.qa_lang_html('markdown/preview').'</h3>' . "\n";
		$html .= '<div id="wmd-preview-'.$fieldname.'" class="md-preview">'.$sane_html.'</div>' . "\n";

    	$html .= '<script src="'.$this->pluginurl.'/preview.js"></script>' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'var replace_text = {'. "\n";
    	$html .= '	bold: "' . qa_lang_html('markdown/bold') .'",'. "\n";
    	$html .= '	italic: "'. qa_lang_html('markdown/italic') .'",'. "\n";
    	$html .= '	quote: "' . qa_lang_html('markdown/quote') . '",'. "\n";
    	$html .= '	url: "' . qa_lang_html('markdown/url') .'",'. "\n";
    	$html .= '	img: "' . qa_lang_html('markdown/img') .'",'. "\n";
    	$html .= '	img_description: "' . qa_lang_html('markdown/img_description') .'",'. "\n";
    	$html .= '	upload: "' . qa_lang_html('markdown/upload') . '",'. "\n";
    	$html .= '	upload_header: "'. qa_lang_html('markdown/upload_header') . '",'. "\n";
    	$html .= '  cancel: "' . qa_lang_html('markdown/cancel') . '",'. "\n";
		$html .= '};'. "\n";
		$html .= "</script>\n";

		return array('type'=>'custom', 'html'=>$html);
	}

	public function read_post($fieldname)
	{
		$html = $this->_my_qa_post_text($fieldname);

		return array(
			'format' => 'markdown',
			'content' => $html
		);
	}

	public function load_script($fieldname)
	{
		$script = "var ajax_url = ".qa_js(qa_path('markdown-ajax')).";\n";
		$script .= "var upload_url = ".qa_js(qa_path('markdown-upload')).";\n";
		$script .= 'setupPreview(ajax_url, upload_url);';

		return $script;
	}


	// set admin options
	public function admin_form(&$qa_content)
	{
		$saved_msg = null;

		if (qa_clicked('markdown_save')) {
			$convert = qa_post_text('md_comments') ? '1' : '0';
			qa_opt($this->convopt, $convert);
			$convert = qa_post_text('md_upload_images') ? '1' : '0';
			qa_opt($this->uploadopt, $convert);

			$saved_msg = qa_lang_html('admin/options_saved');
		}


		return array(
			'ok' => $saved_msg,
					'style' => 'wide',

			'fields' => array(
				'comments' => array(
					'type' => 'checkbox',
					'label' => qa_lang_html('markdown/admin_comments'),
					'tags' => 'NAME="md_comments"',
					'value' => qa_opt($this->convopt) === '1',
					'note' => qa_lang_html('markdown/admin_comments_note'),
				),
				'highlightjs' => array(
					'type' => 'checkbox',
					'label' => qa_lang_html('markdown/admin_syntax'),
					'tags' => 'NAME="md_highlightjs"',
					'value' => qa_opt($this->hljsopt) === '1',
					'note' => qa_lang_html('markdown/admin_syntax_note'),
				),
			),

			'buttons' => array(
				'save' => array(
					'tags' => 'NAME="markdown_save"',
					'label' => qa_lang_html('admin/save_options_button'),
					'value' => '1',
				),
			),
		);
	}


	// copy of qa-base.php > qa_post_text, with trim() function removed.
	private function _my_qa_post_text($field)
	{
		return isset($_POST[$field]) ? preg_replace('/\r\n?/', "\n", qa_gpc_to_string($_POST[$field])) : null;
	}
}
