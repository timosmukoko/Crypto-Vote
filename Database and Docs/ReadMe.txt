1. Install XAMMP
2. FIRST Create a database "poll3"
3. import poll3.sql file to phpmyadmin (Check inside the Database and Docs folder)

4. Anable OpenSSL in your PHP.ini for Cryptography Security encryption
5. Copy and paste entire project folder into C:\xampp\htdocs
6. Open your browser and type: http://localhost/crypto-votes
7. To interact with the software, better see bellow Use cases Documentation 




================/////////////////////////////////////========================
ELECTION AUTHORITY LOGIN DETAILS
URL: http://localhost/crypto-votes/admin/index.php
USER NAME: admin@gmail.com
PASSWORD: admin


================/////////////////////////////////////========================
REGISTRATION AUTHORITY LOGIN DETAILS
http://localhost/crypto-votes/authority-login.php
USER NAME: admin@gmail.com
PASSWORD: admin


================/////////////////////////////////////========================
VOTER LOGIN DETAILS
URL: http://localhost/crypto-votes/login.php
VOTER ID: 1234567A
PASSWORD : Alice_@123


================/////////////////////////////////////========================
CANDIDATE LOGIN DETAILS
URL: http://localhost/crypto-votes/candidatelogin.php
VOTER ID: 1234567F
PASSWORD : Frank_@123



================/////////////////////////////////////========================
USE CASE DOCUMENT


Use Case name 1: Login User
Participating Actor: Candidate, Election Authority, Registration Authority, Voter
Pre-Condition: Good Internet connection
Flow of Events:
1. System prompts the user for login and password.
2. - If User is E.A or R.A, the user enters the email and password.
	- Else the user enters his voter ID and password
3. System responds by authenticating the user.
4. The user dashboard is displayed according to the category of user (admin/voter/candidate).
Alternative Scenario:
4 a. If authorisation fails
4 a.1. The system prints the error message stating the user that he typed the wrong password and allows him to re-enter the password. Give him 3 chances.
Exit Conditions:
1.	The user has been authenticated

Use Case Name 2: Register Voter & Candidate
Participating Actor: Registration Authority
Entry Conditions:
1.	The Registration Authority is currently logged onto the system.
2.	The Registration Authority has clicked on the “Register Voter/Candidate” function.
3.	The use case “Register Voter/Candidate” is invoked.
Flow of Events:
1.	The system responds by displaying the registration form in screen showing fields: first name, last name, email, voter id, is candidate, password and confirm password and “Register Account” button.
2.	The Registration Authority enters the voter first name, last name, voter ID, set a temporary password, confirms the password and hits Register Account button.
3.	The system responds by display a message stating “click OK to process registration”
4.	The Registration Authority click OK
5.	The system responds by stating a message “You have registered member for an account. Election Authority will approve it”.
Exit Conditions:
1.	The voter has been registered into the system.
Special requirements:
1.	The Registration Authority must be logged into the system to register voter
2.	The Election Authority must approve voter.

Use Case Name 3: Approve  Voter & Candidate
Participating Actor: Election Authority
Entry Conditions:
1.	The Election Authority is currently logged onto the system.
2.	The Election Authority has clicked on the “Approve Users” function.
3.	The use case “Approve Users” is invoked.
Flow of Events:
1.	The system responds by displaying the available list of the voter and candidate to approve
2.	The Election Authority clicks Approve Voter/Candidate button.
3.	The system responds by display a message stating “Are sure to delete this user?”
4.	The Election Authority clicks OK.
5.	The system responds and removes the user to the list.
Exit Conditions:
1.	The voter has been removed into the system.
Special requirements:
1.	The Election Authority must be logged into the system to delete voter/candidate


Use Case Name 4: Create Election
Participating Actor: Election Authority
Entry Conditions:
1.	The Election Authority is currently logged onto the system.
2.	The Election Authority has clicked on the “Election” function.
3.	The use case “Elections” is invoked.
Flow of Events:
1.	The system responds and prompts the admin by entering Election name, last date for registration, election start date and election end date.
2.	The E.A enters the election name, the last date for registration, the election start date and the election end date and hits “create election” button.
3.	The system responds and put the election in PAUSED ELECTIONS status condition and provides two link “Start election”, “Cancel election” and “finish election”
3(a). If the E.A clicks start election, the election goes to status condition STARTED ELECTIONS (The election is available into the system)
3(b). If the E.A clicks cancel the lection goes to status condition CANCELLED ELECTIONS (The election is not available into the system)
3(c). If the E.A clicks finish the lection goes to status condition FINISHED ELECTIONS (The election is not any more available into the system)

Exit Conditions:
1.	The election has been created into the system.
Special requirements:
1.	The Registration Authority must be logged into the system to create an election
2.	The Election Authority must click start the election.

Use Case Name 5: Finish Election
Participating Actor: Election Authority
Entry Conditions:
1.	The Election Authority is currently logged onto the system.
2.	The Election Authority has clicked on the “Elections” function.
3.	The use case “Elections” is invoked.
Flow of Events:
1.	The system responds by displaying the elections with their status condition “started”, “paused”, “finished”, “cancelled”.
2.	The Election Authority clicks on “Finish Election” beside the appropriate election.
3.	The system responds by displaying the confirmation message.
4.	The Election Authority confirms and finishes the election.
Exit Conditions:
1.	The election has been finished
Special requirements:
2.	The Registration Authority must be logged into the system to finish election
3.	The Election Authority must click finish election link.

Use Case Name 6: Cancel Election
Participating Actor: Election Authority
Entry Conditions:
1.	The Election Authority is currently logged onto the system.
2.	The Election Authority has clicked on the “Elections” function.
3.	The use case “Elections” is invoked.
Flow of Events:
1.	The system responds by displaying the elections with their status condition “started”, “paused”, “finished”, “cancelled”.
2.	The Election Authority clicks on “Cancel Election” beside the appropriate election.
3.	The system responds by displaying the confirmation message.
4.	The Election Authority confirms and finishes the election.
Exit Conditions:
1.	The election has been cancelled.
Special requirements:
2.	The Registration Authority must be logged into the system to finish election
3.	The Election Authority must click Cancel election link.

Use Case Name 7: Register in Election
Participating Actor: Candidate
Entry Conditions:
1.	The Candidate is currently logged onto the system.
2.	The Candidate has clicked on the “Register in Election” function.
3.	The use case “Register in Election” is invoked.
Flow of Events:
1.	The system responds by displaying the Elections that the candidate can register for and the election that the candidate has registered.
2.	The candidate clicks “register” to the available election in “Election You Can Register”.
3.	System responds by changing status of candidate from “election you can register” to the “election you have registered” 
Exit Conditions:
1.	The Candidate has registered in election.
Special requirements:
2.	The Candidate must be logged into the system to register in election
3.	The Candidate must click register link.

Use Case Name 8: Vote for Candidate
Participating Actor: Voter
Entry Conditions:
1.	The voter is currently logged onto the system.
2.	The voter has clicked on the “vote” function.
3.	The use case “vote” is invoked.
Flow of Events:
1.	The system responds by prompting candidate to enter his registered email address.
2.	The Candidate enters his email and click start. 
3.	The system responds by generating a pin of random 4 digit number and prompts the voter to enter the generated pin.
4.	The voter enters the 4 digits pin number and hits “Submit Pin and vote” button.
5.	The system responds by displaying the available election. With the link “vote in this election” beside each election.
6.	The voter clicks “vote in this election”
7.	The system responds by displaying the different candidates registered for this election, where the voter can view their details.
8.	The voter clicks on the “vote” button beside the desired candidate.
9.	The system responds by displaying a success message and disables the voter from voting further in that particular election.
 Exit Conditions:
1.	The voter has voted.
Special requirements:
2.	The voter must be logged into the system to vote
3.	The vote must have valid registered email to get 4 digit pin.




Use Case Name 9: View Election Result
Participating Actor: Election Authority, Candidate, Voter
Entry Conditions:
1.	The user is currently logged onto the system.
2.	The user has clicked on the “view Election Result” function.
3.	The use case “view Election Result” is invoked.
Flow of Events:
1.	The system responds by displaying “The Completed Elections” table with all finished elections along with link “Show results” beside each election.
2.	The use clicks on the “Show Results” beside the desired election.
3.	The system responds by calculating the result and election statistics. And displays the “Election Results” table containing the data shows all candidates’ votes with the winner of the election in font colour green.
Exit Conditions:
1.	The user has viewed the result.
Special requirements:
2.	The user must be logged into the system to view result
3.	The Election Authority must finish election.
Use Case Name 10: Update Info
Participating Actor: Candidate
Entry Conditions:
4.	The Candidate is currently logged onto the system.
5.	The Candidate has clicked on the “Update Info” function.
6.	The use case “Update Info” is invoked.
Flow of Events:
4.	The system responds by displaying candidate along with ability to update only the info field”.
5.	The candidate update his info and “update info” button
6.	The system responds by updating the info.
Exit Conditions:
4.	The candidate’s info has been updated.
Special requirements:
5.	The candidate must be logged into the system to update his info


Use Case Name 11: Reset Password
Participating Actor: Voter and Candidate
Entry Conditions:
1.	The user is currently logged onto the system.
2.	The user has clicked on the “View Profile” function.
3.	The use case “View Profile” is invoked.
Flow of Events:
1.	The system responds by displaying user’s profile and in the bottom the link “Change password”.
2.	User clicks “Change password” link on bottom.
3.	The system responds by prompting user to enter his old password, new password and confirm new password. 
4.	The user enter old password, new password and confirm new password and clicks “change password” button.
5.	The system responds by stating message “Password reset successful”
Exit Conditions:
1.	The user password has been reset
Special requirements:
1.	The user must be logged into the system to reset his password



