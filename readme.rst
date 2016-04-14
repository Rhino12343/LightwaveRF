###################
LightwaveRF Web Dev Test
###################

This test is written using the Codeigniter framework.
It is being deployed onto a local VM created using Vagrant and VirtualBox.
The virtual box is running PHP 7, Apache, and MySql 5.7

The base url is [server_address]/LightwaveRF/

Users can login to the main area using their username as provided in http://jsonplaceholder.typicode.com/users.

The users password is their email address as requested.

There is a second section of this project located at [server_address]/LightwaveRF/admin.

This allows the user to import, view, and edit the user details stored in the local database.

Please execute the setup.sql file and update the database credentials in LightwaveRF/application/config/database.php