<?php
/*
    Question2Answer Markdown editor plugin

    Custom Markdown parser based on Parsedown, but protecting
    MathJax code from hitting the parser.

    License: http://www.gnu.org/licenses/gpl.html
*/
require_once("parsedown/Parsedown.php");

class ParsedownParser extends Parsedown
{
    protected function inlineSpecialCharacter( $excerpt )
    {
    }
}


class Markdown {

    private static $parser;
    private static $dictionary = [];
    private static $rules = array(
        [
            'start_markdown' => '$$',
            'close_markdown' => '$$',
            'start_tag' => '$$',
            'close_tag' => '$$',
            'is_protected' => true,
            'comment' => 'Protect $$...$$ from Parsedown'
        ],
        [
            'start_markdown' => '$',
            'close_markdown' => '$',
            'start_tag' => '$',
            'close_tag' => '$',
            'is_protected' => true,
            'comment' => 'Protect $...$ from Parsedown'
        ],
        [
            'start_markdown' => '\begin{align}',
            'close_markdown' => '\end{align}',
            'start_tag' => '\begin{align}',
            'close_tag' => '\end{align}',
            'is_protected' => true,
            'comment' => 'Protect \begin{align}...\end{align} from Parsedown'
        ],
        [
            'start_markdown' => '\begin{equation}',
            'close_markdown' => '\end{equation}',
            'start_tag' => '\begin{equation}',
            'close_tag' => '\end{equation}',
            'is_protected' => true,
            'comment' => 'Protect \begin{equation}...\end{equation} from Parsedown'
        ],
        [
            'start_markdown' => '{=',
            'close_markdown' => '=}',
            'start_tag' => '{=',
            'close_tag' => '=}',
            'is_protected' => true,
            'comment' => 'Protect twig macros from Parsedown'
        ]
    );

    /**
     * Performs the required changes before Parsedown sees the input
     *
     * @param MarkdownData $data Contains the text to be parsed
     * @return void. The parsed text is returned in $data
     *
     * @author Frank Wikström <frank@mossadal.se>
     **/

    public static function preMarkdownHook($text) {

        self::$dictionary = [];

        // Apply the rules that protect the markup from the Parsedown interpreter

        foreach(self::$rules as $rule) {
            if ($rule['is_protected']) {
                // This should be a character not found in the search pattern
                $avoid = $rule['start_markdown'] . $rule['close_markdown'];
                $delimiter = self::getDelimiter($avoid);

                $search = $delimiter . preg_quote($rule['start_markdown']) . '(.*?)' . preg_quote($rule['close_markdown']) . $delimiter . 's';

                $text = preg_replace_callback(
                    $search,
                    function($matches) use($rule) {
                        $key = uniqid('xmd').count(self::$dictionary);
                        $replacement = $rule['start_tag'] . $matches[1] . $rule['close_tag'];
                        self::$dictionary[$key] = $replacement;
                        return $key;
                    },
                    $text
                );
            }
        }

        return $text;
    }

    /**
     * Performs the required changes after Parsedown has interpreted the input
     *
     * @param   string          $original   Contains the original text, before
     *                                      preMarkdownHook and Parsedown have done their jobs.
     * @param   MarkdownData    $data       Contains the text parsed so far
     * @return  void                        The parsed text is returned in $data
     *
     * @author Frank Wikström <frank@mossadal.se>
     **/
    public static function postMarkdownHook($text) {

        $rules = array_reverse(self::$rules);

        // First put back all the protected items

        foreach(self::$dictionary as $key => $value) {
            $text = str_replace($key, $value, $text);
        }

        // Then process the other replacement rules.

        foreach ($rules as $rule) {
            if (!$rule['is_protected']) {
                $avoid = $rule['start_markdown'] . $rule['close_markdown'];
                $delimiter = self::getDelimiter($avoid);

                $search = $delimiter . preg_quote($rule['start_markdown']) . '(.*?)' . preg_quote($rule['close_markdown']) . $delimiter . 's';
                $replace = $rule['start_tag'] . '$1' . $rule['close_tag'];

                $text = preg_replace($search, $replace, $text);
            }
        }

        return $text;
    }

    /**
     * Create a delimiter to use with preg_replace. We
     * need to chose one that is *not* present in the regexp
     * pattern.
     * @param string $pattern The regexp pattern
     * @return string A suitable delimiter; one of: #/@%&;:+
     */
    private static function getDelimiter($pattern)
    {
        $candidates = [ '#','/','@','%','&',';',':','+', '|' ];

        foreach ($candidates as $char) {
            if (strpos($pattern, $char) === FALSE) return $char;
        }

        throw new Exception('Could not generate suitable delimiter for regexp.');
    }

    static function init() {
        self::$parser = new ParsedownParser();
    }

    public static function text($text)
    {
        $text = self::preMarkdownHook(htmlspecialchars($text));
        $markup = self::$parser->text($text);
        $markup = self::postMarkdownHook($markup);

        return $markup;
    }

    public static function line($text)
    {
        $text = self::preMarkdownHook(htmlspecialchars($text));
        $markup = self::$parser->line($text);
        $markup = self::postMarkdownHook($markup);

        return $markup;
    }
}

Markdown::init();
