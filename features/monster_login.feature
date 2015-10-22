Feature: Log in and out of the site.
  In order to maintain an account
    As a site visitor
    I need to log in and out of the site.

@monsterlogin
Scenario: Logs in to the site
  Given I am on "/"
  When I follow "Sign In"
    And I fill in "EmailAddress" with "simon.jones@mailinator.com"
    And I fill in "Password" with "12Xxxxxxxxx"
    And I press "Sign In"
  Then I should see "Welcome Simon"
    And I should see "Jobs You Might Like"

@monsterlogin
Scenario: Logs out of the site
  Given I am on "/"
  When I follow "Sign In"
    And I fill in "EmailAddress" with "simon.jones@mailinator.com"
    And I fill in "Password" with "12Xxxxxxxxx"
    And I press "Sign In"
  Then I should see "Welcome Simon"
    And I should see "Jobs You Might Like"
    And I click on account "signOut"
  Then I should see "You have been Signed Out" 

@skip
Scenario: Test Function
  Given I am on "/"
  Then I should see "david lloyd"

@wip
Scenario: Attempts login with wrong credentials.
  Given I am on "/"
  When I follow "Sign In"
    And I fill in "EmailAddress" with "simon.jones@mailinator.com"
    And I fill in "Password" with "p12Xxxxxxxxx"
    And I press "Sign In"
  Then I should not see "Welcome Simon"
  And I should see "Whoops, we noticed something incorrect..."

@monsterlogin
Scenario: Register a unique user
  Given I am on "/"
  When I follow "Join Us"
  Then I should see "Sign Up for Monster with Email"
    And I fill in "EmailAddress" with a unique email "simon.jones@mailinator.com"
    And I fill in "Password" with "12Xxxxxxxxx"
    And I fill in "FirstName" with "Simon"
    And I fill in "LastName" with "Jones"
    And I fill in "UserEnteredZipName" with "WC1A1AB"
    And I select "16" from "CareerLevelID"
    And I select "12" from "EducationLevelID"
    And I select "1" from "OptiInEmailCarrerRelated1"
    And I select "1" from "OptiInEmailMeMonsterPartner1"
    And I press "Create account" 
  Then I should not see "Whoops, we noticed something incorrect..."
