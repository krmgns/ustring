<?php
/**
 * Copyright 2013, Kerem Gunes <http://qeremy.com/>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

/**
 * @class UString v0.1
 */
class UString
{
    // Self default encoding
    const DEFAULT_ENCODING = 'UTF-8';

    // Self string
    protected $_string;
    // Self encoding
    protected $_encoding;
    // Current (system) encoding
    protected $_encodingCurrent;

    /**
     * Create an UString object with given params
     *
     * @param string $string
     * @param string $encoding
     */
    public function __construct($string, $encoding = self::DEFAULT_ENCODING) {
        // We need multibyte extension
        if (!function_exists('mb_internal_encoding')) {
            throw new UStringException('We need "mbstring" extension!');
        }

        // Set vars
        $this->_string = $string;
        $this->_encoding = $encoding;

        // Get current encoding
        $this->_encodingCurrent = mb_internal_encoding();

        // Set internal encoding
        mb_internal_encoding($this->_encoding);
    }

    /**
     * Restore internal encoding
     */
    public function __destruct() {
        mb_internal_encoding($this->_encodingCurrent);
    }

    /**
     * Helper for print out
     *
     * @return string
     */
    public function __toString() {
        return $this->stringify();
    }

    /**
     * Set string, actually re-set self $_string
     *
     * @param string $string
     */
    public function set($string) {
        $this->_string = $string;
    }

    /**
     * Get string, not same with self::stringify()
     * That could return a string or array after some methods such shuffle()
     *
     * @return mixed self $_string
     */
    public function get() {
        return $this->_string;
    }

    /**
     * Convert to lower-cased string
     *
     * @return string
     */
    public function toLower() {
        return mb_strtolower($this->stringify());
    }

    /**
     * Convert to upper-cased string
     *
     * @return string
     */
    public function toUpper() {
        return mb_strtoupper($this->stringify());
    }

    /**
     * Convert to title-cased string
     *
     * @return string
     */
    public function toTitle() {
        return mb_convert_case($this->stringify(), MB_CASE_TITLE);
    }

    /**
     * Convert to slug string
     *
     * @param boolean $lc (to lower case)
     * @return string
     */
    public function slugify($lc = true) {
        // Get extension file
        include_once __DIR__ .'/extra/UStringSlugify.php';

        $str = $this->stringify();
        $str = UStringSlugify::convert($str);
        if ($lc) {
            $str = strtolower($str);
        }

        return $str;
    }

    /**
     * Simply lcfirst for unicode
     *
     * @return string
     */
    public function toLowerFirst() {
        $str = $this->stringify();
        if ($this->isASCII()) {
            return lcfirst($str);
        }
        return mb_strtolower(mb_substr($str, 0, 1)) . mb_substr($str, 1);
    }

    /**
     * Simply ucfirst for unicode
     *
     * @return string
     */
    public function toUpperFirst() {
        $str = $this->stringify();
        if ($this->isASCII()) {
            return ucfirst($str);
        }
        return mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1);
    }

    /**
     * Simply lcwords for unicode
     *
     * @return string
     */
    public function toLowerWords() {
        $str = $this->stringify();
        if ($this->isASCII()) {
            return lcwords($str);
        }

        return preg_replace_callback('~^\w|\s+(\w)~u', function($m) {
            return mb_strtolower($m[0]);
        }, $str);
    }

    /**
     * Simply ucwords for unicode
     *
     * @return string
     */
    public function toUpperWords() {
        $str = $this->stringify();
        if ($this->isASCII()) {
            return ucwords($str);
        }

        return preg_replace_callback('~^\w|\s+(\w)~u', function($m) {
            return mb_strtoupper($m[0]);
        }, $str);
    }

    /**
     * Get first chr
     *
     * @return string
     */
    public function first() {
        return $this->substring(0, 1);
    }

    /**
     * Get last chr
     *
     * @return string
     */
    public function last() {
        return $this->substring(-1);
    }

    /**
     * Get nth chr
     *
     * @param  int $i
     * @return string
     */
    public function nth($i) {
        return $this->substring($i, 1);
    }

    /**
     * Is first chr is given chr?
     *
     * @param  string  $chr
     * @return boolean
     */
    public function firstCharIs($chr) {
        return (bool) ($this->first() == $chr);
    }

    /**
     * Is last chr is given chr?
     *
     * @param  string  $chr
     * @return boolean
     */
    public function lastCharIs($chr) {
        return (bool) ($this->last() == $chr);
    }

    /**
     * Is nth chr is given chr?
     *
     * @param  int     $i (chr index)
     * @param  string  $chr
     * @return boolean
     */
    public function nthCharIs($i, $chr) {
        return (bool) ($this->nth($i) == $chr);
    }

    /**
     * Shift first chr from string
     * Note: This method affects self $_string
     *
     * @return string
     */
    public function shift() {
        $tmp = $this->_explode();
        $str = array_shift($tmp);
        $this->set($this->_implode($tmp));
        return $str;
    }

    /**
     * Pop last chr from string
     * Note: This method affects self $_string
     *
     * @return string
     */
    public function pop() {
        $tmp = $this->_explode();
        $str = array_pop($tmp);
        $this->set($this->_implode($tmp));
        return $str;
    }

    /**
     * Reverse string
     * Note: This method affects self $_string
     *
     * @return object self
     */
    public function reverse() {
        if ($this->isASCII()) {
            $str = strrev($this->stringify());
        } else {
            $tmp = array_reverse($this->_explode());
            $str = $this->_implode($tmp);
        }
        $this->set($str);
        return $this;
    }

    /**
     * Shuffle string
     * Note: This method affects self $_string
     *
     * @return object self
     */
    public function shuffle() {
        if ($this->isASCII()) {
            $str = str_shuffle($this->stringify());
        } else {
            $tmp = $this->_explode();
            shuffle($tmp);
            $str = $this->_implode($tmp);
        }
        $this->set($str);
        return $this;
    }

    /**
     * Get sub-string
     *
     * @param  int $start
     * @param  int $length
     * @return string
     */
    public function substring($start, $length = null) {
        if ($this->isASCII()) {
            // If length=null then returns nothing, interesting...
            return $length === null
                ? substr($this->stringify(), $start)
                : substr($this->stringify(), $start, $length);
        }
        return $this->_implode(array_slice(
                    $this->_explode(), $start, $length));
    }

    /**
     * Count sub-string frequency
     *
     * @param  string  $substr
     * @param  boolean $caseSensitive
     * @return int
     */
    public function countSubstring($substr, $caseSensitive = true, $offset = 0, $length = null) {
        $str = $this->stringify();
        if ($offset) {
            $str = $this->substring($offset, $length);
        }

        $pattern = $caseSensitive
            ? '~(?:'. preg_quote($substr) .')~u'
            : '~(?:'. preg_quote($substr) .')~ui';
        preg_match_all($pattern, $str, $matches);

        return isset($matches[0]) ? count($matches[0]) : 0;
    }

    /**
     * Count chars frequency
     *
     * @param  boolean $x (
     *     $x = â     // frequency of "â"
     *     $x = true  // all chars with own frequencies
     *     $x = false // count of uniq chars
     * )
     * @return mixed
     */
    public function countChars($x = false) {
        $chrs = array();
        $tmp  = $this->_explode();

        foreach ($tmp as $t) {
            $chrs[$t] = isset($chrs[$t]) ? $chrs[$t] + 1 : 1;
        }

        if (is_bool($x)) {
            return $x ? $chrs : count($chrs);
        }

        return $chrs[$x];
    }

    /**
     * Get length
     *
     * @return int
     */
    public function length() {
        return mb_strlen($this->stringify());
        // if ($this->isASCII()) {
        //     return strlen($this->stringify());
        // }
        // return count($this->_explode());
    }

    /**
     * Find position of given src
     *
     * @param  string  $src
     * @return int
     */
    public function position($src, $caseSensitive = true, $offset = 0) {
        if ($this->isASCII()) {
            return $caseSensitive
                ? strpos($this->stringify(), $src, $offset)
                : stripos($this->stringify(), $src, $offset);
        }

        return $caseSensitive
            ? mb_strpos($this->stringify(), $src, $offset)
            : mb_stripos($this->stringify(), $src, $offset);

        // I just remembered mb_ position funstions :)
        // $tmp = $this->_explode();
        // $cnt = count($tmp);
        // for ($i = $offset; $i < $cnt; $i++) {
        //     $val = $tmp[$i];
        //     if (!$caseSensitive) {
        //         $val = mb_strtolower($val);
        //     }
        //     if ($val == $src) {
        //         return $i;
        //     }
        // }
        // return false;
    }

    /**
     * Find left position of src
     *
     * @param  string $src
     * @return int
     */
    public function positionLeft($src, $caseSensitive = true, $offset = 0) {
        return $this->position($src);
    }

    /**
     * Find right position of src
     *
     * @param  string $src
     * @return int
     */
    public function positionRight($src, $caseSensitive = true, $offset = 0) {
        if ($this->isASCII()) {
            return $caseSensitive
                ? strrpos($this->stringify(), $src, $offset)
                : strripos($this->stringify(), $src, $offset);
        }

        return $caseSensitive
            ? mb_strrpos($this->stringify(), $src, $offset)
            : mb_strripos($this->stringify(), $src, $offset);

        // I just remembered mb_ position funstions :)
        // $tmp = $this->_explode();
        // $cnt = count($tmp);
        // for ($i = ($cnt - 1); $i >= $offset; $i--) {
        //     $val = $tmp[$i];
        //     if (!$caseSensitive) {
        //         $val = mb_strtolower($val);
        //     }
        //     if ($val == $src) {
        //         return $i;
        //     }
        // }
        // return false;
    }

    /**
     * Alias of self::nth
     *
     * @param  int $i
     * @return string
     */
    public function charAt($i) {
        return $this->nth($i);
    }

    /**
     * Shortcut for "preg_match"
     *
     * @param  string $pattern
     * @return mixed
     */
    public function match($pattern, &$matches = false) {
        if ($matches === false) {
            return (bool) preg_match($pattern, $this->stringify());
        }
        preg_match($pattern, $this->stringify(), $matches);
    }

    /**
     * Get random part of string by given length
     *
     * @param  integer $length
     * @return string
     */
    public function random($length = 1) {
        $chrs = array();
        $ustr = new self($this->stringify());
        $tmp  = $ustr->shuffle()->_explode();
        for ($i = 0; $i < $length; $i++) {
            $chrs[] = $tmp[$i];
        }
        return $this->_implode($chrs);
    }

    /**
     * Append something at the ending
     *
     * @param  string $string
     * @return object self
     */
    public function append($string) {
        $tmp = $this->stringify();
        $this->set($tmp . $string);
        return $this;
    }

    /**
     * Prepend something at the begining
     *
     * @param  string $string
     * @return object self
     */
    public function prepend($string) {
        $tmp = $this->stringify();
        $this->set($string . $tmp);
        return $this;
    }

    /**
     * Surround with given chr
     *
     * @param  string $chr
     * @return object self
     */
    public function surround($chr) {
        $this->append($chr)->prepend($chr);
        return $this;
    }

    /**
     * Strip both left & right
     *
     * @param  string $chr
     * @return object self
     */
    public function strip($chr) {
        $chr = preg_quote($chr);
        $str = preg_replace("~(^[$chr]*)|([$chr]*$)~us", '', $this->stringify());
        $this->set($str);
        return $this;
    }

    /**
     * Strip left
     *
     * @param  string $chr
     * @return object self
     */
    public function stripLeft($chr) {
        $chr = preg_quote($chr);
        $str = preg_replace("~(^[$chr]*)~us", '', $this->stringify());
        $this->set($str);
        return $this;
    }

    /**
     * Strip right
     *
     * @param  string $chr
     * @return object self
     */
    public function stripRight($chr) {
        $chr = preg_quote($chr);
        $str = preg_replace("~([$chr]*$)~us", '', $this->stringify());
        $this->set($str);
        return $this;
    }

    /**
     * Replace
     *
     * @param  mixed  $from
     * @param  mixed  $to
     * @param  boolean $caseSensitive (not implemented yet, use $from=['Ü','ü'] instead)
     * @return string
     */
    public function replace($from, $to, $caseSensitive = false) {
        $tmp = str_replace($from, $to, $this->stringify());
        $this->set($tmp);
        return $this->get();
    }

    /**
     * Translate
     *
     * @param  mixed  $from
     * @param  string $to
     * @return string
     */
    public function translate($from, $to = '') {
        $str = $this->stringify();

        if (is_array($from)) {
            $this->set(strtr($str, $from));
        } else {
            $from  = preg_split('~~u', $from, -1, PREG_SPLIT_NO_EMPTY);
            $to    = preg_split('~~u', $to, -1, PREG_SPLIT_NO_EMPTY);
            $trans = array_combine(array_values($from), array_values($to));
            $this->set(strtr($str, $trans));
        }

        return $this->get();
    }

    /**
     * Chunk by given length
     *
     * @param  integer $length
     * @param  string  $end
     * @return string
     */
    public function chunk($length = 76, $end = "\r\n") {
        if ($this->isASCII()) {
            return chunk_split($this->stringify(), $length, $end);
        }

        $tmp = array_chunk($this->_explode(), $length);
        $str = '';
        foreach ($tmp as $t) {
            $str .= join('', $t) . $end;
        }

        return $str;
    }

    /**
     * Split by given length
     *
     * @param  integer $length
     * @return array
     */
    public function split($length = 1) {
        if ($this->isASCII()) {
            return str_split($this->stringify(), $length);
        }

        $tmp = $this->_explode();
        if ($length > 1) {
            $chunks = array_chunk($tmp, $length);
            foreach ($chunks as $i => $chunk) {
                $chunks[$i] = join('', (array) $chunk);
            }
            $tmp = $chunks;
        }

        return $tmp;
    }

    /**
     * Make a string if self $_string is not string
     *
     * @return string
     */
    public function stringify() {
        return $this->_implode();
    }

    /**
     * Check whether or not ASCII
     *
     * @param  boolean $extended
     * @return boolean
     */
    public function isASCII($extended = false) {
        $result = $extended
            ? preg_match('~^[\x00-\xFF]*$~', $this->stringify())
            : preg_match('~^[\x00-\x7F]*$~', $this->stringify());
        return (bool) $result;
    }

    /**
     * Explode self $_string
     *
     * @return array
     */
    protected function _explode() {
        return preg_split('~~u', $this->_string, -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * Implode self $_string
     *
     * @param  mixed  $str
     * @param  string $s   (join tool)
     * @return [type]
     */
    protected function _implode($str = null, $s = '') {
        if ($str == null) {
            $str = $this->_string;
        }
        if (is_array($str)) {
            $str = join($s, $str);
        }
        return $str;
    }
}