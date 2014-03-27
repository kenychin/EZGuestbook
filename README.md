PHP-EZGuestbook (v1.5)
===============

Super easy guestbook, started by win, modified by masterk.

-----

## Program Functions

* Display comments in guestbook
   * easy to modify the look & replacements through CSS
   * comments are filtered (HTML disabled) to preserve the guestbook format
* Receive comments form submissions
* Validate comments submitted
   * check required fields, duplicated comments
* Write comments to MySQL database
   * include basic user info: ip

### To Do List
* Reply to comments
   * display in indented format
* Admin panel
   * Modify comments
   * Delete comments

-----

## Main Programs List

### index.php
Main page of the guestbook

### write_form.php
Comment form

### write.php
Receive, validate, and store comment
