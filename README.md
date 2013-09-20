A simple string manipulation library (multibyte = true).

**Usage**

```php
$ustr = new UString('Üzüm', 'UTF-8');

print $ustr; // Üzüm
print $ustr->toLower(); // üzüm
```

**Methods**

[](#)

*[set](#set)
*[get](#get)
*[toLower](#toLower)
*[toUpper](#toUpper)


#### set
```php
$ustr->set('New string!');
```

#### get
```php
print $ustr->get();
```

#### toLower
```php
print $ustr->toLower(); // üzüm
```

#### toUpper
```php
print $ustr->toUpper(); // ÜZÜM
```
