# behat3-mink-website
BDD - Behat 3 with Mink and Mink Extensions against monster.co.uk website
  
<b>This example will demonstrate the following:  </b>  
1. Failed steps via AfterStep hook screenshots saved into the screenshot directory  
2. Mink-Extensions libray of pre-existing steps  
3. Behat  
4. Custom Steps e.g. to create unique registrations on monster.co.uk  
  
<b>Notes:  </b>
1. PHP needed ( comes standard on a Mac, or install)  
2. use the terminal  
3. Java needed ( comes standard on a Mac- I think?, or install)  
4. I have noticed that using the Chrome browser brings up the new monster.co.uk website on www6.monster.co.uk. Firefox appears to only bring this site up on every 4th request.  
5. I needed to add php.ini date timezone = 'Europe/London' for the php date command to work  
6. use different tags @wip or none to run all the scenarios.  
    
The instructions below are likely to work on a Linux or Mac    
    
<b>Steps </b> 
1. Download this repository  
2. get composer  
````curl -sS https://getcomposer.org/installer | php  ````  
3. run the command  
````php composer.phar install  ````  
4. download the standalone Selenium 2 Webdriver Jar file ( http://seleniumhq.org)  
5. start the standalone Selenium2 webdriver ( open up another terminal )   
````java -jar ./selenium-server-standalone-2.48.2.jar ````  
6. execute the behat test using  
````./vendor/bin/behat --tags @wip --append-snippets --suite=backend ./features/monster_search.feature````  
