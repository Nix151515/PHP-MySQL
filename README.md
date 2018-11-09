# PHP-MySQL
Locally hosted website

The user visiting the site is able to :
- Create an account and login using the chosen credentials
- Receive emails
- See the last login timestamp
- Participate in a poll and see the all-time results

The database contains two tables: 
- Users ("utilizatori") with fields : id, name, username, password, email, checkbox(to accept mails).
- Question with fields : id, selection(response), choices(nr of similar responses)
