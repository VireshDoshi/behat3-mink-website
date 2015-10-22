<?php

use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Driver\Selenium2Driver;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements SnippetAcceptingContext
{
    private $screenShotPath;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct($screen_shot_path)
    {
	$this->screenShotPath = $screen_shot_path;
    }
   
     /**
     * @AfterStep
     */
    public function takeScreenshotAfterFailedStep(AfterStepScope $scope)
    {
        if (99 === $scope->getTestResult()->getResultCode()) {
            $this->takeScreenshot();
        }
    }

    private function takeScreenshot()
    {
        echo "screenshotpath=[" . $this->screenShotPath . "]\n";
        $driver = $this->getSession()->getDriver();
        if (! $driver instanceof Selenium2Driver) {
        	echo "Not an instance of selenium2\n";
            return;
        }
	if (! is_dir($this->screenShotPath)) {
                mkdir($this->screenShotPath, 0777, true);
        }

        $filename = sprintf(
             '%s_%s_%s.%s',
             $this->getMinkParameter('browser_name'),
             date('Ymd') . '-' . date('His'),
             uniqid('', true),
             'png'
        );

        $this->saveScreenshot($filename, $this->screenShotPath);
    }

    /**
     * @Then I fill in :arg1 with a unique email :arg2
     */
    public function iFillInWithAUniqueEmail($in_field, $in_email)
    {
       	$session = $this->getSession(); 
       	$page=$session->getPage();
	$random_num=mt_rand();
	$parts= explode('@',$in_email);
	$user=$parts[0];
	$domain=$parts[1];
       	$email_element=$page->find('css','#' . $in_field);
	$random_email = $user . $random_num . '@' . $domain;
        $email_element->setValue($random_email);
	echo "generated random email = [" . $random_email . "]\n";
    }

    /**
     * @Then I hover over the logged in Name
     */
    public function iHoverOverTheLoggedInName()
    {
	$session=$this->getSession();
	$current_url=$session->getCurrentUrl();
	echo "url=[" . $current_url . "]";
	#if($session->getCurrentUrl() != "http://www.monster.co.uk/"){
	#	throw new \Exception("the newer site has been loaded");
	#}
	$page=$session->getPage();
	$mainNav=$page->find('css','#mainNav');
	$staticNav=$page->find('css','#StaticNav');
	$top_nav_elements=$mainNav->findAll('xpath','//span');
	$top_right_nav_elements=$staticNav->findAll('xpath','//li');
	$sign_in_el=$staticNav->find('css','#Li1');
	$sign_in_el->mouseOver();
	sleep(2);
	foreach($top_right_nav_elements as $top_right_nav_element){
		$top_r_n_e_class=$top_right_nav_element->getAttribute('class');
		echo "class=[" . $top_r_n_e_class . "]\n";
		#$top_right_nav_element->mouseOver();
		#sleep(2);
		if($top_r_n_e_class === "signOut"){
			$sign_out_ele = $top_right_nav_element->find('xpath','//a');	
			$sign_out_ele->click();
			return true;
		}
	}
	#foreach($top_nav_elements as $top_nav_element){
	#	$top_nav_element->mouseOver();	
	#	sleep(2);
	#}
    }

    /**
     * @Given I click on account :arg1
     */
    public function iClickOnAccount($in_account_link_class)
    {
	$session=$this->getSession();
	$current_url=$session->getCurrentUrl();
	echo "url=[" . $current_url . "]";
	$page=$session->getPage();
	$staticNav=$page->find('css','#StaticNav');
	$top_right_nav_elements=$staticNav->findAll('xpath','//li');
	$sign_in_el=$staticNav->find('css','#Li1');
	$sign_in_el->mouseOver();
	sleep(2);
	foreach($top_right_nav_elements as $top_right_nav_element){
		$top_r_n_e_class=$top_right_nav_element->getAttribute('class');
		echo "class=[" . $top_r_n_e_class . "]\n";
		if($top_r_n_e_class === $in_account_link_class){
			$sign_out_ele = $top_right_nav_element->find('xpath','//a');	
			$sign_out_ele->click();
			return true;
		}
       }
    }

}
