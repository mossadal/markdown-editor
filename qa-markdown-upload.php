<?php
/*
    Question2Answer by Gideon Greenspan and contributors
    http://www.question2answer.org/

    File: qa-plugin/wysiwyg-editor/qa-wysiwyg-upload.php
    Description: Page module class for WYSIWYG editor (CKEditor) file upload receiver


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


class qa_markdown_upload
{
    public function match_request($request)
    {
        return ($request == 'markdown-upload');
    }

    public function process_request($request)
    {
        $message = '';
        $url = '';


        if (is_array($_FILES) && count($_FILES)) {

            //if (!qa_opt('md_upload_images'))
            //    $message = qa_lang('users/no_permission');

            require_once QA_INCLUDE_DIR.'qa-app-upload.php';

            $upload = qa_upload_file_one(
                null,    //qa_opt('wysiwyg_editor_upload_max_size'),
                1,   //qa_get('qa_only_image'),
                null, //qa_get('qa_only_image') ? 600 : null, // max width if it's an image upload
                null // no max height
            );

            $message = @$upload['error'];
            $url = @$upload['bloburl'];
        }

        echo json_encode(array(
            'url' => $url,
            'message' => $message
        ));

    }
}
