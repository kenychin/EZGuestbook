PHP-EZGuestbook (v1.5)
===============

Super easy guestbook, started by win, modified by masterk.

-----

## Program Functions

* Display comments in guestbook MySQL database
   * easy to modify the look, style & placements through CSS
   * comments are filtered (HTML disabled) to preserve the guestbook format
* Receive comments form submissions
* Validate comments submitted
   * check required fields, duplicated comments
* Write comments to MySQL database
   * include basic user info: ip
* Write replies to database
* Cookies enabled after submission

### To Do List
* Display
  * Time am/pm
* Validate comments
   * reduce comments to 4000(?) length
* Admin panel
   * Login, session enabled
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


-----

## Database Setup

![Database](http://master2.com/gb/guestbook_db.png)
