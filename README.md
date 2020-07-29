# Url Shortner

Your service is going to receive an URL as a parameter that must be shortened with the
following rules:
1. Minimum length: five chars
2. Maximum length: ten chars
3. Use only letters and numbers
4. Use PHP
5. Use tests
The returned URL should be saved in a database, having an expiration date (you may
choose the expiration date). The response must be the shortened URL.
When your application receives the shortened URL, the response should redirect your
client to the correct URL you saved in the database.
Shorted sample

- Your application must receive a request to shorten the URL (ex.:
myurlshortener.com) and return a JSON body:
{ newUrl: "http://localhost:8081/abc123ab" }
Redirection sample

- When you receive a shortened URL, the application must be resolved and return
the clean URL or a 404 HTTP error.


## HTTP GET Requests

```python
Convert original Url to shortened Url
------------------------------------------
{baseUrl}/convert-url/{incomingUrlParameter}
ex.) localhost.me/convert-url/www.google.com


Use Shortened Url
------------------------------------------
Inside browser or postman, load shortened Url
to be redirected to the original Url
```

## UnitTest
```python
Runs 1 test with 3 assertions
phpunit tests/Feature/UrlMapTest.php
```
