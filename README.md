
Markdown Editor plugin for Question2Answer
=================================================

This is an editor plugin for popular open source Q&A platform, [Question2Answer](http://www.question2answer.org). It uses Markdown to format posts, which is a simple text-friendly markup language using for example \*\*bold\*\* for **bold text** or \> for quoting sources.

The plugin uses erusev/Parsedown for parsing the Markdown code, as well as custom rules to
protect MathJax from the Markdown parser.

This plugin is partially based on another Markdown editor for Q2A that can be found at [GitHub](https://github.com/svivian/q2a-markdown-editor)


Installation
-------------------------------------------------

1. Download and extract the `qa-markdown-editor` folder to the `qa-plugins` folder in your Q2A installation.
2. If your site is a different language from English, copy `qa-md-lang-default.php` to the required language code (e.g. `qa-tt-lang-de.php` for German) and edit the phrases for your language.
3. Log in to your Q2A site as a Super Administrator and head to Admin > Posting.
4. Set the default editor for questions and answers to 'Markdown Editor'. The editor does also work for comments, but keeping to plain text is recommended.




Extra bits
-------------------------------------------------

**Converting old posts:** If you have been running your Q2A site for a little while, you may wish to convert old content to Markdown. This does not work reliably for HTML content (created via the WYSIWYG editor); it is pretty safe for plain text content, but check your posts afterwards as some formatting may go awry. You can convert text posts automatically using this SQL query:

    UPDATE qa_posts SET format='markdown' WHERE format='' AND type IN ('Q', 'A', 'Q_HIDDEN', 'A_HIDDEN')

(Make sure to change `qa_` above to your installation's table prefix if it is different.)

