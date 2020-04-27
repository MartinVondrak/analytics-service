# USER STORY
I, as business analyst want simple server, where I will input/send customer data (in .csv file) and get
- recommended action for them (see Resolver)
- basic statistics (see Stats)

So I can decide on marketing action.

## Technical assignment
- Create Backend server application in PHP. 
- It will accept POST request with attached (.csv) file.
- It will return a json response with data (bellow).
- The API will be under user/password protection - basic auth.
- Do not forget to follow VF standards (design patterns, !!UNIT TESTING!!, naming)

## Technical recommendations:
- Minimum of 3 classes
  - One will receive request and orchestrate the logic
  - Second will parse the input
  - Third will resolve the customer action
  - You can have as many classes as you want
	
### Parser
- Input will be .csv data
  - NAME, CREDIT, LAST_TOP_UP_DATE (dd.mm.yyyy)
	
### Resolver
- 3 Rules
  - CREDIT < 200 ----> action: SMS
  - LAST TOP UP DATE > 5 months -----> action: SMS
  - CREDIT <= 300 && LAST TOP UP DATE < 2 months ----> action: SMS
  - other (do not meet the criteria above) -----> action: NONE

### Stats
- Action x count
	
## Other Notes
- Follow our standards.pdf guide
- You can use attached .csv file as input
- You are NOT allowed to use any framework.
- Do not use any libraries or frameworks (You can use only composer for PHP Unit and PHP Stan, Code sniffer) 
- You are recommended to use Composer to load PHP Unit and static analytic tools
- Use PHP 7.2 
- Do not work for more than 6 hours (we want to see what you can do in that time)
- Application does not need to be perfect, but it should be working

## Usage
You need Composer and PHP 7.2 to run this application.
```
$ composer install
$ vendor/bin/phpstan analyse -c phpstan.neon
$ vendor/bin/phpunit tests/
$ php -S <ip-addr>:<port> -t public
$ curl -F "data=@<path-to-file>" http://admin:pass@<ip-addr>:<port>
```
