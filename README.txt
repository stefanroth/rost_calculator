Summary
========================================
rost_calculator is a small module that provides a basic calculator as a field formatter to Drupal 8.

Installation
========================================
Copy the module source into your Drupal 8 installation folder under:
<DRUPAL-ROOT>/modules/

Usage
========================================
- Create a view with (at least) one field of types "text", "text_long", "summary" or "string".
- Apply the formatter "Rost Calculator" to it.

If the field value contains a calculation (i.E. 2*9-4/2) the view will show the calculation and the result
(2*9-4/2 = 16)