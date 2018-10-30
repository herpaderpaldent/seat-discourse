# Version 1.0.1
This version is a fix for logout job. It was bad designed as it resulted in a closure exception. This fix was provided by @warlof. Thank you very much.
* Added Style CI to repo.

# Version 1.0.0
This is the first release with all its functionality. Since version 0.9.2 `SeAT-Discourse` was very stable and did not need a lot of refactoring or bug-fixing. However, i still had some ToDo's noted. The next few update still have some functional refactoring however functionally it does not change. Also some documentation will be added, whenever i find time and motivation to do so. 

These are the things changed with this version:

* Logging out Job introduced
** This Job will be dispatched if a `refresh_token` in an `user group` is deleted.
* Refactoring of unneeded actions
* Introduction of the about-page to inform you if a new version is available.
* Introduction of changelog.
* Disallow login if `user group` is missing a `refresh_token`.

I was looking into automatically logging out members whenever they receive a new role. Unfortunately this is not achieved easily without events dispatched whenever someone receives a role. This would need change in `SeAT` (vanilla), which i am not able to push by myself. This might be added to a later moment.

