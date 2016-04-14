###################
LightwaveRF Web Dev Test
###################
<br>
This test is written using the Codeigniter framework.<br>
It is being deployed onto a local VM created using Vagrant and VirtualBox.<br>
The virtual box is running PHP 7, Apache, and MySql 5.7<br>
<br>
The base url is [server_address]/LightwaveRF/<br>
<br>
Users can login to the main area using their username as provided in http://jsonplaceholder.typicode.com/users.<br>
<br>
The users password is their email address as requested.<br>
<br>
There is a second section of this project located at [server_address]/LightwaveRF/admin.<br>
<br>
This allows the user to import, view, and edit the user details stored in the local database.<br>
<br>
Please execute the setup.sql file and update the database credentials in LightwaveRF/application/config/database.php<br>