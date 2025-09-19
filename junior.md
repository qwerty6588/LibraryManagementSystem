# 50+ Junior PHP Developer Interview Questions & Answers

## 1. Basics
**Q1:** What is PHP?  
**A:** PHP is a popular server-side scripting language mainly used for web development.

**Q2:** What does PHP stand for?  
**A:** Originally *Personal Home Page*, now *PHP: Hypertext Preprocessor*.

**Q3:** Is PHP case-sensitive?  
**A:** Partially. Variable names are case-sensitive, but function names are not.

**Q4:** What is the default file extension for PHP?  
**A:** `.php`

**Q5:** How do you write comments in PHP?  
**A:** Single-line: `//` or `#`, Multi-line: `/* */`.

**Q6:** Difference between echo and print?  
**A:** `echo` outputs text faster and can take multiple arguments, `print` returns 1 and is slower.

**Q7:** Difference between == and ===?  
**A:** `==` compares values only, `===` compares both value and type.

**Q8:** What is the difference between single and double quotes in PHP?  
**A:** Double quotes parse variables, single quotes do not.

**Q9:** How do you declare a variable in PHP?  
**A:** Use `$` followed by the variable name, e.g., `$name = "John";`.

**Q10:** What are the main data types in PHP?  
**A:** String, Integer, Float, Boolean, Array, Object, NULL, Resource.

---

## 2. Arrays & Strings
**Q11:** What are the types of arrays in PHP?  
**A:** Indexed, Associative, and Multidimensional arrays.

**Q12:** How to merge arrays in PHP?  
**A:** Use `array_merge($array1, $array2)`.

**Q13:** How to check if a key exists in an array?  
**A:** Use `array_key_exists('key', $array)`.

**Q14:** How do you count elements in an array?  
**A:** Use `count($array)`.

**Q15:** How to split a string into an array?  
**A:** Use `explode('delimiter', $string)`.

**Q16:** How to join an array into a string?  
**A:** Use `implode('delimiter', $array)`.

---

## 3. Control Structures
**Q17:** What is the difference between include and require?  
**A:** `require` stops script execution on failure, `include` does not.

**Q18:** What is the difference between include_once and include?  
**A:** `include_once` includes a file only once even if called multiple times.

**Q19:** What are alternative syntax for control structures in PHP?  
**A:** Use colons instead of braces, e.g., `if: endif;`.

---

## 4. Functions
**Q20:** What are default arguments in PHP?  
**A:** Function parameters with default values if no argument is passed.

**Q21:** Difference between pass by value and reference?  
**A:** Pass by value copies the value, pass by reference uses `&` to modify original.

**Q22:** How to declare a function in PHP?  
**A:** `function functionName() { ... }`

**Q23:** How to return multiple values from a function?  
**A:** Return an array or object.

---

## 5. Superglobals & Forms
**Q24:** What are PHP superglobals?  
**A:** `$_GET`, `$_POST`, `$_REQUEST`, `$_SESSION`, `$_COOKIE`, `$_SERVER`, `$_FILES`, `$_ENV`, `$_GLOBALS`.

**Q25:** Difference between $_GET and $_POST?  
**A:** `$_GET` sends data via URL, `$_POST` sends data in request body.

**Q26:** How do you retrieve query string parameters in PHP?  
**A:** Use `$_GET['param']`.

---

## 6. Sessions & Cookies
**Q27:** How do you start a session in PHP?  
**A:** Use `session_start()` at the beginning of the script.

**Q28:** How do you set a cookie in PHP?  
**A:** Use `setcookie('name','value',time()+3600)`.

**Q29:** How do you delete a cookie?  
**A:** Set its expiration time to the past, e.g., `setcookie('name','',time()-3600)`.

---

## 7. Error Handling
**Q30:** How do you enable error reporting in PHP?  
**A:** `error_reporting(E_ALL); ini_set('display_errors',1);`.

**Q31:** What is try-catch used for?  
**A:** For handling exceptions.

---

## 8. OOP
**Q32:** What is a class in PHP?  
**A:** A class is a blueprint for creating objects.

**Q33:** What is an object in PHP?  
**A:** An instance of a class.

**Q34:** What are access modifiers?  
**A:** `public`, `private`, `protected`.

**Q35:** What is inheritance?  
**A:** A class can inherit properties and methods from another class using `extends`.

**Q36:** What is an interface in PHP?  
**A:** A contract that classes can implement using the `implements` keyword.

**Q37:** What are traits in PHP?  
**A:** A way to reuse methods across multiple classes.

**Q38:** What are constructors and destructors?  
**A:** `__construct()` initializes objects, `__destruct()` cleans up.

---

## 9. Security
**Q39:** What is SQL Injection?  
**A:** An attack by injecting malicious SQL code. Prevent using prepared statements.

**Q40:** What is XSS?  
**A:** Cross-Site Scripting. Prevent by escaping output and validating input.

**Q41:** How do you hash passwords in PHP?  
**A:** Use `password_hash()` and verify with `password_verify()`.

---

## 10. Database
**Q42:** How to connect to MySQL?  
**A:** Using `mysqli` or `PDO`.

**Q43:** Difference between mysqli and PDO?  
**A:** PDO supports multiple databases, mysqli supports only MySQL.

**Q44:** What is a prepared statement?  
**A:** A precompiled SQL query that prevents SQL injection.

---

## 11. Composer & Tools
**Q45:** What is Composer?  
**A:** A dependency manager for PHP.

**Q46:** What are PSR standards?  
**A:** PHP Standards Recommendations for coding style and practices.

---

## 12. PHP Versions
**Q47:** Difference between PHP 7 and PHP 8?  
**A:** PHP 8 introduced JIT, union types, attributes, named arguments.

---

## 13. Practical Coding
**Q48:** How do you reverse a string in PHP?  
**A:** Use `strrev($string)`.

**Q49:** How to check if a number is prime in PHP?  
**A:** Loop from 2 to `sqrt($n)` and check divisibility.

**Q50:** How to upload a file in PHP?  
**A:** Use `$_FILES` with an HTML form using `enctype="multipart/form-data"`.

**Q51:** How to read a file in PHP?  
**A:** Use `file_get_contents('filename.txt')` or `fopen()` with `fread()`.

**Q52:** How to write to a file in PHP?  
**A:** Use `file_put_contents('filename.txt', 'data')` or `fopen()` with `fwrite()`.

**Q53:** How to sort an associative array by value?  
**A:** Use `asort($array)`.

---

## 14. Extra
**Q54:** What is type hinting in PHP?  
**A:** Specifying data type of parameters or return type in functions.

**Q55:** What is namespace in PHP?  
**A:** It is a way to group related classes and avoid name conflicts.

**Q56:** What is autoloading in PHP?  
**A:** Automatically loading classes using `spl_autoload_register()`.


