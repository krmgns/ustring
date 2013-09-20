<?php
$encoding = 'UTF-8';

header('Content-Type: text/plain; charset='. $encoding);

require_once __DIR__ .'/../UString/UStringException.php';
require_once __DIR__ .'/../UString/UString.php';

$ustr = new UString('Üzüm gözlü YÂR!', $encoding);
// $ustr = new UString('Is this a test kiss?', $encoding);

// pre($ustr->toLower());
// pre($ustr->toUpper());
// pre($ustr->toTitle());

// pre($ustr->charAt(0));
// pre($ustr->position('ü', false));
// pre($ustr->positionLeft('ü'));
// pre($ustr->positionRight('ü'));

// pre($ustr->substring(1));
// pre($ustr->substring(-1));
// pre($ustr->substring(-5));
// pre($ustr->substring(-5, 1));
// pre($ustr->substring(0, 1));
// pre($ustr->substring(0, -1));
// pre($ustr->substring(-3, -1));

// pre($ustr->countChars());
// pre($ustr->countSubstring('is', true));
// pre($ustr->countSubstring('is', false));
// pre($ustr->countSubstring('is', false, 1));

// pre($ustr->length());

// pre($ustr->first());
// pre($ustr->last());
// pre($ustr->nth(0));

// pre($ustr->firstIs('Ü'));
// pre($ustr->lastIs('m'));
// pre($ustr->nthIs(0, 'Ü'));

// pre($ustr->shift());
// pre($ustr->pop());

// pre($ustr->random(3));

// $ustr->reverse();
// $ustr->shuffle();

// $ustr->append('...');
// $ustr->prepend('...');
// $ustr->surround('|');
// $ustr->strip('|');
// $ustr->stripLeft('|');
// $ustr->stripRight('|');

// $ustr->replace('ü', 'u');
// $ustr->replace(array('Ü', 'ü'), '...');
// $ustr->replace(array('Ü', 'ü'), array('U', 'u'));

// $ustr->translate('Üü', 'Uu');
// $ustr->translate(array('ö' => 'o'));

// pre($ustr->chunk(3));
// pre($ustr->split());
// pre($ustr->split(2));

// pre($ustr->toLowerFirst());
// pre($ustr->toUpperFirst());
// pre($ustr->toLowerWords());
// pre($ustr->toUpperWords());

// pre($ustr->slugify());

// $x = $ustr->match('~(ü)~');
// pre($x);
// $ustr->match('~(ü)~', $x);
// pre($x);

// pre($ustr->isASCII());

pre('');
pre($ustr->get());

function pre($s, $e = false) {
    printf("%s\n", print_r($s, 1));
    $e && exit;
}
