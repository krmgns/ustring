A simple string manipulation library (multibyte = true).

**Usage**

```php
$ustr = new UString('Üzüm üzüm', 'UTF-8');

print $ustr; // Üzüm üzüm
print $ustr->toLower(); // üzüm üzüm
```

**Methods**

[](#)

* [set](#set)
* [get](#get)
* [toLower](#toLower)
* [toUpper](#toUpper)
* [toTitle](#toTitle)
* [slugify](#slugify)
* [toLowerFirst](#toLowerFirst)
* [toUpperFirst](#toUpperFirst)
* [toLowerWords](#toLowerWords)
* [toUpperWords](#toUpperWords)
* [first](#first)
* [last](#last)
* [nth](#nth)
* [firstCharIs](#firstCharIs)
* [lastCharIs](#lastCharIs)
* [nthCharIs](#nthCharIs)
* [shift](#shift)
* [pop](#pop)
* [reverse](#reverse)
* [shuffle](#shuffle)
* [substring](#substring)


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







