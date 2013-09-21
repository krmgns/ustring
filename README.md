A simple string manipulation library (multibyte = true).

**Usage**

```php
$ustr = new UString('Üzüm üzüm', 'UTF-8');

print $ustr; // Üzüm üzüm
print $ustr->toLower(); // üzüm üzüm
```

**Methods**

* [set](#set)
* [get](#get)
* [toLower](#tolower)
* [toUpper](#toupper)
* [toTitle](#totitle)
* [slugify](#slugify)
* [toLowerFirst](#tolowerfirst)
* [toUpperFirst](#toupperfirst)
* [toLowerWords](#tolowerwords)
* [toUpperWords](#toupperwords)
* [first](#first)
* [last](#last)
* [nth](#nth)
* [firstCharIs](#firstcharis)
* [lastCharIs](#lastcharis)
* [nthCharIs](#nthcharis)
* [shift](#shift)
* [pop](#pop)
* [reverse](#reverse)
* [shuffle](#shuffle)
* [substring](#substring)
* [countSubstring](#countsubstring)
* [countChars](#countchars)
* [length](#length)
* [position positionLeft positionRight](#position-positionleft-positionright)
* [charAt](#charat)
* [match](#match)
* [random](#random)
* [append](#append)
* [prepend](#prepend)
* [surround](#surround)
* [strip stripLeft stripRight](#strip-stripleft-stripright)
* [replace](#replace)
* [translate](#translate)
* [chunk](#chunk)
* [split](#split)


#### set
```php
$ustr->set('New string!');
```

#### get
```php
print $ustr->get(); // Üzüm üzüm
```

#### toLower
```php
print $ustr->toLower(); // üzüm üzüm
```

#### toUpper
```php
print $ustr->toUpper(); // ÜZÜM ÜZÜM
```

#### toTitle
```php
print $ustr->toTitle(); // Üzüm Üzüm
```

#### slugify
```php
print $ustr->slugify(); // uzum-uzum
print $ustr->slugify(false); // Uzum-uzum
```

#### toLowerFirst
```php
print $ustr->toLowerFirst(); // üzüm üzüm
```

#### toUpperFirst
```php
print $ustr->toUpperFirst(); // Üzüm üzüm
```

#### toLowerWords
```php
print $ustr->toLowerWords(); // üzüm üzüm
```

#### toUpperWords
```php
print $ustr->toUpperWords(); // Üzüm Üzüm
```

#### first
```php
print $ustr->first(); // Ü
```

#### last
```php
print $ustr->last(); // m
```

#### nth
```php
print $ustr->nth(); // m
```

#### firstCharIs
```php
print $ustr->firstCharIs('Ü'); // true
```

#### lastCharIs
```php
print $ustr->lastCharIs('m'); // true
```

#### nthCharIs
```php
print $ustr->nthCharIs(2, 'ü'); // true
```

#### shift
```php
print $ustr->shift(); // Ü
print $ustr->shift(); // ü
print $ustr->get(); // üm üzüm
```

#### pop
```php
print $ustr->pop(); // m
print $ustr->pop(); // ü
print $ustr->get(); // Üzüm üz
```

#### reverse
```php
print $ustr->reverse();
print $ustr->get(); // müzü müzÜ
```

#### shuffle
```php
print $ustr->shuffle();
print $ustr->get(); // zü ümüzÜm
```

#### substring
```php
print $ustr->substring(1);
print $ustr->substring(-1);
print $ustr->substring(-5);
print $ustr->substring(-5, 1);
print $ustr->substring(0, 1);
print $ustr->substring(0, -1);
print $ustr->substring(-3, -1);
```

#### countSubstring
```php
print $ustr->countSubstring('ü', true);     // 3
print $ustr->countSubstring('ü', false);    // 4
print $ustr->countSubstring('ü', false, 3); // 2
```

#### countChars
```php
print $ustr->countChars('ü');   // frequency of "ü" (int)
print $ustr->countChars(true);  // all chars with own frequencies (array)
print $ustr->countChars(false); // count of uniq chars (int)

/*
3
Array
(
    [Ü] => 1
    [z] => 2
    [ü] => 3
    [m] => 2
    [ ] => 1
)
5
*/
```

#### length
```php
print $ustr->length(); // 9
```

#### position positionLeft positionRight
```php
print $ustr->position('ü');        // 2
print $ustr->position('ü', false); // 0
print $ustr->positionLeft('ü');    // 2 (alias of position)
print $ustr->positionRight('ü');   // 7
```

#### charAt
```php
print $ustr->charAt(0); // Ü (alias of nth)
```

#### match
```php
print $ustr->match('~(ü)~'); // 1

$ustr->match('~(ü)~', $ms);
print_r($ms); // array(...)
```

#### random
```php
print $ustr->random();  // m
print $ustr->random(3); // zmÜ
```

#### append
```php
$ustr->append('...');
print $ustr->get() // Üzüm üzüm...
```

#### prepend
```php
$ustr->prepend('...');
print $ustr->get() // ...Üzüm üzüm
```

#### surround
```php
$ustr->surround('|');
print $ustr->get() // |Üzüm üzüm|
```

#### strip stripLeft stripRight
```php
$ustr->strip('Üüm');
print $ustr->get() // züm üz
$ustr->stripLeft('Ü');
print $ustr->get() // züm üzüm
$ustr->stripRight('üm');
print $ustr->get() // Üzüm üz
```

#### replace
```php
print $ustr->replace('ü', 'u');
print $ustr->replace(array('Ü', 'ü'), '...');
print $ustr->replace(array('Ü', 'ü'), array('U', 'u'));
```

#### translate
```php
print $ustr->translate('Üü', 'Uu');        // Uzum uzum
print $ustr->translate(array('ö' => 'o')); // Ü@üm ü@üm
```

#### chunk
```php
print $ustr->chunk(3); // array(...)
```

#### split
```php
print $ustr->split(); // array(...)
```

#### stringify
```php
print $ustr->stringify(); // Üzüm üzüm
```

#### isASCII()
```php
print $ustr->isASCII(); // false (Üzüm üzüm)

$ustr->set('Hello PHP!');
print $ustr->isASCII(); // true
```




