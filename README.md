PHP Forms library v1.1
=======================

##What
A PHP Form library that is mostly object oriented.  I was tired of looking at all the PHP Form libraries that were simply
arrays and this solves the problem mostly.  It's easier to work with in an IDE (class && function hints).  Fully documented
and has an example.

##How to use it
Check the example.  Pretty self explanatory

##Wishlist
* Fix all constructors to take just the label
** Interior of the constructor I want it to use a private init function instead of the parent constructor.
* Allow form to take multiple form items with the same label and add _(n) to the form id
* AJAX-y-ness
* Wizard capabilities
* Better templating
* Rename functions
* Register callback functions for buttons (cancel, reset etc), validations and extra submit handlers
* Set control theme (set theme for certain fields to override)
* Set form theme so that the developer can use their own theme instead.
