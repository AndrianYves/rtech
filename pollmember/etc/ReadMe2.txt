==================================================================================
FUNCTIONALITIES : ( na kulang pa sa Poll & Voting System )
==================================================================================

>> FAILING FUNCTIONALITIES =======================================================

** Responsiveness / adaptability
** Can hide the poll ( Super Admin / Admin )
** Even when the page was refresh / reloaded, the contents must still have the same attr as to before the page was reloaded


>> THE QUESTIONABLES =============================================================

[?] User can vote multiple times ( dapat ONCE lang )


>> THE ALANGANIN =================================================================

[/] [?] User can choose which poll to vote on


>> THE BALAKID SA BUHAY KO =======================================================

[X] Not user - friendly
	-> Pindot here -- pindot there, bes \_('^')_/


>> WORKING FUNCTIONALITIES =======================================================

[/] SA / Admin can ADD / VIEW / DELETE a poll
	- > Walang "update" a poll. Update lang sa # of votes via database after user has successfully voted.

	** HELPFUL websites :
	>> HIDING POLL :
	https://www.drupal.org/forum/support/theme-development/2009-11-18/solved-how-to-display-only-percentage-results-for-poll
	https://css-tricks.com/how-to-design-and-create-a-php-powered-poll/

	>> HIDE BUTTON :
	https://stackoverflow.com/questions/31984440/i-want-to-hide-the-submit-button-based-on-a-phpcondition-through-javascript/31984692
	https://stackoverflow.com/questions/38057996/php-code-to-show-a-hidden-button
	https://www.daniweb.com/programming/web-development/threads/378624/php-and-hiding-submit-buttons