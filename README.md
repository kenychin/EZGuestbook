PHP-EZGuestbook (v1.5)
===============

Super easy guestbook by masterk
(original by win)

-----

## Program Functions

* Main page: read comments from MySQL database
   * styled through CSS (style_gb.css)
   * comments filtered (HTML disabled)
* Form: allows new comments and replies
   * check required fields, duplicated comments
   * include basic user info: ip, user_agent
  * Cookies enabled after submission
* Admin panel:
  * Login enables session
  * Modify comments
  * Delete comments

### To Do List
* Validate comments
   * reduce comments to 4000(?) length
  * replies to 2000(?) length
* Enable img and a markup

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

* r_id - reference id (a reply to a specific comment)
* del - deleted (0 or 1)
* env - provides additional space to add user env variables, and admin comments
