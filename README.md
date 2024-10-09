Prerequisites

This application was created using PHP and Vanilla Javascript. It uses an SQL database.


Completed Stories

1 - Create a shopping list that can contain a list of groceries (groceries will exist in 'products' table of database)

2 - Create a way for a user to add an item to the shopping list

3 - Create a way for user to remove an item to the shopping list

4 - When I’ve bought something from my list I want to be able to cross it off the list

5 - Persist the data so I can view the list if I move away from the page

7 - Display the total cost for the whole shop

8 - Spending limit in place which can be set/reset by the user

9 - Ability to share shopping list via email

10 - Add a login system to persist shopping lists for different users (Registration and login system)

Incomplete Stories (not enough time left)

6 - Create a way for user to be able to change the order of items in their shopping list



How to setup

- git clone https://github.com/alexsomersetdesign/shopping-list-application.git
- Create Localhost evironment
- Check model/database.php to ensure correct path and credentials
- DB is included within the project files.  (DB should be empty aside a few products existing within 'products' table) and import tables NOTE: occassionally I get issues opening SQL files and running the query (my work machine is fairly old!). Importing of file resolves this issue for me.
- Ensure SMTP credentials are correct in model/user.php (line 14-20)
- Register a user and login

If there are any issues whatsoever, please do not hesitate to contact me.

  

