<?php
/*
    Question2Answer by Gideon Greenspan and contributors
    http://www.question2answer.org/

    File: qa-plugin/wysiwyg-editor/qa-wysiwyg-editor.php
    Description: Editor module class for WYSIWYG editor plugin


    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License
    as published by the Free Software Foundation; either version 2
    of the License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    More about this license: http://www.question2answer.org/license.php
*/


require_once "Markdown.php";


class qa_markdown_ajax
{
    public function match_request($request)
    {
        return $request == 'markdown-ajax';
    }

    public function process_request($request)
    {
        $parser = new Markdown;
        $html = $parser->text($_GET['text']);

        $sane_html = qa_sanitize_html($html, @$options['linksnewwindow']);

        echo json_encode(array('html' => $sane_html));
    }
}
