Feature: Logged in user can manage their account
  In order to use Monster Job Acount management
    As a logged in site visitor
    I can perform actions that allow me to manage my account

Background: Logs in to the site
  Given I am on "/"
  When I follow "Sign In"
    And I fill in "EmailAddress" with "simon.jones@mailinator.com"
    And I fill in "Password" with "12Xxxxxxxxx"
    And I press "Sign In"
  Then I should see "Welcome Simon"
    And I should see "Jobs You Might Like"

Scenario: Go to the edit settings page
  Given I am on "/"
  And I click on account "accountSettings"
  Then I should see "Edit your basic account settings"

Scenario: Go to the edit edit profile page
  Given I am on "/"
  And I click on account "editProfile"
  Then I should see "Contact Information"

Scenario Outline: Click through the account pages and assert present using Scenario Outline
  Given I click on account "editProfile"
  Then I should see "Contact Information"
  And I follow "<account_link>"
  Then I should see "<expected_text>"

Examples:
| account_link | expected_text |
| Photo        | Choose a photo for your professional profile. |
| Education    | Degree Level |

@wip
Scenario: Goto the Edit Profile Page and then assert that the side navigation bar contains teh correct entries using a table
  Given I click on account "editProfile"
  Then I should see "Contact Information"
  And I should see the following in the side navigation:
  | title_text | 
  | Contact Information |
  | Photo|
  | Professional Overview |
  | Experience |
  | Eduation |
  | Certifications |
  | Skills | 

@skip
Scenario: Test Function
  Given I am on "/"
  Then I should see "david lloyd"

