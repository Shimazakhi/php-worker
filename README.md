# PHP Worker

Imports CSV file Contacts from file, generates Contact jpeg card containing name, last name, email. 
Locates domain name, IP address from Card Email. Submits each new processed entry to *.env@CONTACT_PUSH_URL
Processing is handled by resque workers. Work is performed in async job queue. You can run one / multiple workers with differnet Queue Adapters. 
Multiple workers require Supervisor management. 

Basic API Provides JSON access to imported content via enpoints.   

* Clone directory and update dependencies
* Copy .env.example .env and set your personal configuration.
* Start worker 
* ```
	composer worker:default
* Run migrations
* ```
	php console database migrate
* Initiate import process
* ```
	php console import 

Imported data is accessible by endpoints:
```
	GET /contacts.php (contacts.php?limit=5&page=3)
	GEt /timezones.php (timezones.php?timezone=<timezone>&limit=5&page=3)
