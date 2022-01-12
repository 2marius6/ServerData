# ServerData
 Another uni project, done in the winter semester of the second year, a web platform for viewing real-time and historical data about a number of servers.

# How it works
This project has three main components: 
- a python script, grabbing the data from a server, and sending it to the database (https://github.com/2marius6/Python-real-data-grabbber)
- a MySQL database where all data about servers is stored
- the web platform itself

When getting to the index page for the first time, the user will be prompted to the login page. If he is a simple user, it will be able to see data just for it's own server, as well as change it's login password. If it's an admin, he will be able to see data about all registered servers, change it's own login password, as well as register new users and delete existing ones.

# Features
For simple users:
- see location of your server, and real-time info about it on a Google map
- see data history of your server graphically and in a table, on the period choosen
- change your login password

For admin:
- see location of all registered servers, and real-time info about them on a Google map
- see data history of all servers in a table, on the period choosen
- change your login password
- register new users/delete existing users
