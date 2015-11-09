<?php
/*
    Question2Answer by Gideon Greenspan and contributors
    http://www.question2answer.org/

    File: qa-plugin/example-page/qa-example-page.php
    Description: Page module class for example page plugin


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

class qa_markdown_help
{
    private $directory;
    private $urltoroot;


    public function load_module($directory, $urltoroot)
    {
        $this->directory=$directory;
        $this->urltoroot=$urltoroot;
    }


    public function suggest_requests() // for display in admin interface
    {
        return array(
            array(
                'title' => 'Example',
                'request' => 'example-plugin-page',
                'nav' => 'M', // 'M'=main, 'F'=footer, 'B'=before main, 'O'=opposite main, null=none
            ),
        );
    }


    public function match_request($request)
    {
        return $request == 'markdown-help';
    }


    public function process_request($request)
    {
        $qa_content=qa_content_prepare();

        $qa_content['title']=qa_lang_html('markdown/help_title');
        // $qa_content['error']='An example error';
        $qa_content['custom']= qa_lang('markdown/help_text');


        return $qa_content;
    }
}
