--TEST--
Test debug_zval_dump() function : basic operations
--SKIPIF--
<?php
if (PHP_INT_SIZE != 8) die("skip this test is for 64bit platform only");
?>
--INI--
precision=14
allow_call_time_pass_reference=1
--FILE--
<?php
/* Prototype: void debug_zval_dump ( mixed $variable );
   Description: Dumps a string representation of an internal zend value 
                to output.
*/

/* creating file resource */
$file_handle = fopen(__FILE__, "r");

echo "*** Testing debug_zval_dump() on scalar and non-scalar variables ***\n";
$values = array (
  /* integers */
  0,  // zero as argument
  000000123,  //octal value of 83
  123000000,
  -00000123,  //octal value of 83
  -12300000,
  0xffffff,  //hexadecimal value
  123456789,
  1,
  -1,

  /* floats */
  -0.0,
  +0.0,
  1.234,
  -1.234,
  -2.000000,
  2.0000000,
  -4.0001e+5,
  4.0001E+5,
  6.99999989,
  -.5,
  .567,
  -.6700000e-3,
  -.6700000E+3,
  1E-5,
  -1e+5,
  1e+5,
  1E-5,

  /* strings */
  "",
  '',
  " ",
  ' ',
  "0",
  "\0",
  '\0',
  "\t",
  '\t',
  "PHP",
  'PHP',
  "1234\t\n5678\n\t9100\rabcda\x0000cdeh\0stuv",  // strings with escape chars

  /* boolean */
  TRUE,
  FALSE,
  true,
  false,

  /* arrays */
  array(),
  array(NULL),
  array(true),
  array(""),
  array(''),
  array(array(1, 2), array('a', 'b')),
  array("test" => "is_array", 1 => 'One'),
  array(0),
  array(-1),
  array(10.5, 5.6),
  array("string", "test"),
  array('string', 'test'),

  /* resources */
  $file_handle
);
/* loop to display the variables and its reference count using
    debug_zval_dump() */
$counter = 1;
foreach( $values as $value ) {
  echo "-- Iteration $counter --\n";
  debug_zval_dump( $value );
  debug_zval_dump( &$value );
  $counter++;
}

/* closing resource handle */
fclose($file_handle);  

echo "Done\n";
?>
--EXPECTF--
*** Testing debug_zval_dump() on scalar and non-scalar variables ***
-- Iteration 1 --
long(0) refcount(3)
&long(0) refcount(2)
-- Iteration 2 --
long(83) refcount(3)
&long(83) refcount(2)
-- Iteration 3 --
long(123000000) refcount(3)
&long(123000000) refcount(2)
-- Iteration 4 --
long(-83) refcount(3)
&long(-83) refcount(2)
-- Iteration 5 --
long(-12300000) refcount(3)
&long(-12300000) refcount(2)
-- Iteration 6 --
long(16777215) refcount(3)
&long(16777215) refcount(2)
-- Iteration 7 --
long(123456789) refcount(3)
&long(123456789) refcount(2)
-- Iteration 8 --
long(1) refcount(3)
&long(1) refcount(2)
-- Iteration 9 --
long(-1) refcount(3)
&long(-1) refcount(2)
-- Iteration 10 --
double(0) refcount(3)
&double(0) refcount(2)
-- Iteration 11 --
double(0) refcount(3)
&double(0) refcount(2)
-- Iteration 12 --
double(1.234) refcount(3)
&double(1.234) refcount(2)
-- Iteration 13 --
double(-1.234) refcount(3)
&double(-1.234) refcount(2)
-- Iteration 14 --
double(-2) refcount(3)
&double(-2) refcount(2)
-- Iteration 15 --
double(2) refcount(3)
&double(2) refcount(2)
-- Iteration 16 --
double(-400010) refcount(3)
&double(-400010) refcount(2)
-- Iteration 17 --
double(400010) refcount(3)
&double(400010) refcount(2)
-- Iteration 18 --
double(6.99999989) refcount(3)
&double(6.99999989) refcount(2)
-- Iteration 19 --
double(-0.5) refcount(3)
&double(-0.5) refcount(2)
-- Iteration 20 --
double(0.567) refcount(3)
&double(0.567) refcount(2)
-- Iteration 21 --
double(-0.00067) refcount(3)
&double(-0.00067) refcount(2)
-- Iteration 22 --
double(-670) refcount(3)
&double(-670) refcount(2)
-- Iteration 23 --
double(1.0E-5) refcount(3)
&double(1.0E-5) refcount(2)
-- Iteration 24 --
double(-100000) refcount(3)
&double(-100000) refcount(2)
-- Iteration 25 --
double(100000) refcount(3)
&double(100000) refcount(2)
-- Iteration 26 --
double(1.0E-5) refcount(3)
&double(1.0E-5) refcount(2)
-- Iteration 27 --
string(0) "" refcount(3)
&string(0) "" refcount(2)
-- Iteration 28 --
string(0) "" refcount(3)
&string(0) "" refcount(2)
-- Iteration 29 --
string(1) " " refcount(3)
&string(1) " " refcount(2)
-- Iteration 30 --
string(1) " " refcount(3)
&string(1) " " refcount(2)
-- Iteration 31 --
string(1) "0" refcount(3)
&string(1) "0" refcount(2)
-- Iteration 32 --
string(1) " " refcount(3)
&string(1) " " refcount(2)
-- Iteration 33 --
string(2) "\0" refcount(3)
&string(2) "\0" refcount(2)
-- Iteration 34 --
string(1) "	" refcount(3)
&string(1) "	" refcount(2)
-- Iteration 35 --
string(2) "\t" refcount(3)
&string(2) "\t" refcount(2)
-- Iteration 36 --
string(3) "PHP" refcount(3)
&string(3) "PHP" refcount(2)
-- Iteration 37 --
string(3) "PHP" refcount(3)
&string(3) "PHP" refcount(2)
-- Iteration 38 --
string(34) "1234	
5678
	9100abcda 00cdeh stuv" refcount(3)
&string(34) "1234	
5678
	9100abcda 00cdeh stuv" refcount(2)
-- Iteration 39 --
bool(true) refcount(3)
&bool(true) refcount(2)
-- Iteration 40 --
bool(false) refcount(3)
&bool(false) refcount(2)
-- Iteration 41 --
bool(true) refcount(3)
&bool(true) refcount(2)
-- Iteration 42 --
bool(false) refcount(3)
&bool(false) refcount(2)
-- Iteration 43 --
array(0) refcount(3){
}
&array(0) refcount(2){
}
-- Iteration 44 --
array(1) refcount(3){
  [0]=>
  NULL refcount(1)
}
&array(1) refcount(2){
  [0]=>
  NULL refcount(2)
}
-- Iteration 45 --
array(1) refcount(3){
  [0]=>
  bool(true) refcount(1)
}
&array(1) refcount(2){
  [0]=>
  bool(true) refcount(2)
}
-- Iteration 46 --
array(1) refcount(3){
  [0]=>
  string(0) "" refcount(1)
}
&array(1) refcount(2){
  [0]=>
  string(0) "" refcount(2)
}
-- Iteration 47 --
array(1) refcount(3){
  [0]=>
  string(0) "" refcount(1)
}
&array(1) refcount(2){
  [0]=>
  string(0) "" refcount(2)
}
-- Iteration 48 --
array(2) refcount(3){
  [0]=>
  array(2) refcount(1){
    [0]=>
    long(1) refcount(1)
    [1]=>
    long(2) refcount(1)
  }
  [1]=>
  array(2) refcount(1){
    [0]=>
    string(1) "a" refcount(1)
    [1]=>
    string(1) "b" refcount(1)
  }
}
&array(2) refcount(2){
  [0]=>
  array(2) refcount(2){
    [0]=>
    long(1) refcount(1)
    [1]=>
    long(2) refcount(1)
  }
  [1]=>
  array(2) refcount(2){
    [0]=>
    string(1) "a" refcount(1)
    [1]=>
    string(1) "b" refcount(1)
  }
}
-- Iteration 49 --
array(2) refcount(3){
  ["test"]=>
  string(8) "is_array" refcount(1)
  [1]=>
  string(3) "One" refcount(1)
}
&array(2) refcount(2){
  ["test"]=>
  string(8) "is_array" refcount(2)
  [1]=>
  string(3) "One" refcount(2)
}
-- Iteration 50 --
array(1) refcount(3){
  [0]=>
  long(0) refcount(1)
}
&array(1) refcount(2){
  [0]=>
  long(0) refcount(2)
}
-- Iteration 51 --
array(1) refcount(3){
  [0]=>
  long(-1) refcount(1)
}
&array(1) refcount(2){
  [0]=>
  long(-1) refcount(2)
}
-- Iteration 52 --
array(2) refcount(3){
  [0]=>
  double(10.5) refcount(1)
  [1]=>
  double(5.6) refcount(1)
}
&array(2) refcount(2){
  [0]=>
  double(10.5) refcount(2)
  [1]=>
  double(5.6) refcount(2)
}
-- Iteration 53 --
array(2) refcount(3){
  [0]=>
  string(6) "string" refcount(1)
  [1]=>
  string(4) "test" refcount(1)
}
&array(2) refcount(2){
  [0]=>
  string(6) "string" refcount(2)
  [1]=>
  string(4) "test" refcount(2)
}
-- Iteration 54 --
array(2) refcount(3){
  [0]=>
  string(6) "string" refcount(1)
  [1]=>
  string(4) "test" refcount(1)
}
&array(2) refcount(2){
  [0]=>
  string(6) "string" refcount(2)
  [1]=>
  string(4) "test" refcount(2)
}
-- Iteration 55 --
resource(%d) of type (stream) refcount(4)
&resource(%d) of type (stream) refcount(2)
Done
