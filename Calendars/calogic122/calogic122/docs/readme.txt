CaLogic Readme File
===========================

Please read all documentation in the docs folder.

For installation instrunctions, read installing.txt

For quick installation instructions read quick-install.txt

For updat instrunctions, read updating.txt

Some notes on the setup/update/configure options:

   All options can be changed later by logging on as admin, then selecting
   "CaLogic Config" under the Admin heading of the Functions menu.

   If you choose to use the "Public View" option, then you will be taken
   directly to the "Public" calendar when the install is finished.
   If you did not choose to use the "Public View" you will be taken to
   the logon / register screen.

   When you logon for the first time, you will be taken to the Calendar Creation
   screen. Enter a calendar name and title for your first calendar. You must save now
   before you can change the other Calendar Config options.

   If you plan on using the "Standard Default Calendar" option, you must make an open
   or public calendar for this purpose.

   If you choose "Public View", a user named "Guest", Password "Guest", Calendar "Guest"
   will be created. The user and Calendar "Guest" are special. They can't be deleted
   thru normal means. They can only be deleted by turning off the "Public View" function.
   The guest user also cannot create other calendars, events, contacts or anything else.
   It can only view events on any public or open calendar.

   CaLogic is designed so that every user, guest or not, must have a calendar. For this
   reason, when you delete a user, all calendars owned by that user are also deleted.
   Because the "Guest" Calendar is owned by the Guest user, if you turn off the
   Public View later, the guest user and guest calendar will be deleted.
   The "Guest Calendar" isn't meant to be used for storing events. It is just a means
   of providing you a way to allow surfers to view your Public / Open Calendars,
   without them having to register first.

   The "Public View" function works best with the "Standard Default Calendar" option. With
   both these options turned on, the "Guest" user will be taken to the "Standard Default
   Calendar" when entering the site. However, if you don't want to use the Standard Default
   Calendar option, you still have the option of setting the Guest users standard calendar
   to any open / public calendar. Only admin users are allowed to set this option for the
   guest user.


   Turning on "Demo Mode" will effectively turn CaLogic into a "Free For All" Calendar web site.
   However, the Admin functions can still only be changed by admin users, and sensitive
   information will be hidden from non admin users


Here is some clarity on the way CaLogic handles users and calendars in conjunction
with differnt option settings.

   Each calendar can be owned by only one user. The user that created the calendar is
   the owner of it.

   A user can create more than one calendar if the "Standard Default Calendar" option
   is turned off and the "User can customize" option is turned on.

   Only the admin can delete any user. However a user can delete him/her self.

   You cannot delete your self if you are logged on as an admin. However, you can
   delete other admin users.

   If you delete a user, all calendars owned by that user will also be deleted, as will
   all the events on those calendars.

   If you delete a calendar, the user is not deleted. If however, you have no other
   calendars, you will be prompted to create one the next time you log on. Also, if
   you delete your last calendar, you will be logged off and taken to the logon screen.

   Only the Admin or the owner of a calendar may change the settings of that calendar.
   Furthermore, the user can only change the settings if the "User can customize"
   option is turned on.

   If you turn on the "Standard Default Calendar" option, all current and future users
   will have the calendar you select set as thier default, including the Guest user.
   All functions that allow users to switch their default calendar will be turned off and disabled.
   This option does not delete any calendars even if you turn it off later.

   If the "Standard Default Calendar" option is turned on, you cannot delete the calendar
   that is defined as the "Standard Default".

   When you turn off the "Standard Default Calendar" option, CaLogic attempts to reset
   each users default calendar to a calendar the user owns. If the user has no calendars,
   the user will be prompted to create one upon the users next logon.


This is all very logical once you get used to using CaLogic. Trust me. :-)





TO DO LIST
==========

A good program is never finished.

None of the things on my TODO list, cause CaLogic not to work, or to
"Hang" or any thing like that. Things I haven't done yet, or are not
finished yet, simply aren't available in the program.
But because I still constantly work on CaLogic, errors may happen.
Please let me know if you run into any errors so that I can fix them.

Things I still need to do, or am currently working on:

There is a lot of hard coded English that still has to be added to the
language table. Once this is done, I will translate it to German as well.
So, although you as admin have the possibility to edit the language table,
I wouldn't do it just yet.

IMPORTANT!!!!
If you do edit the Language table, be warned: there are some entries with
PHP script in them. %index% for example. This code is used for inserting
variable values. If it is changed, then the text output may not be as
expected.

An extensive Event Search routine has yet to be made.

I plan to also make a "Find Free Time" routine, which will be able to
locate an unscheduled timeframe for an event.

The final documentation is not yet finished, nor the FAQ. Which will probably
end up being one in the same. But basically this means you are on your own as
far as the use of the calendar. But hey, if you need help, send me a mail,
I will be glad to help. Besides, CaLogic is very easy to use.

Implement more user requests.

Make an option to allow an event to be shareable. Which means
any user could opt to have the event show up on thier own calendar.

Make an option to allow a calendar to be shareable. Which means
any user could opt to have all the events of a shared calendar
show up on thier calendar. This will be good for example if you
have one calendar with holidays, any user could then opt to have
the events of the holiday calendar show up on thier calendar.



Thanks and remember, CaLogic is still (always) in development, so this is a great
time for feature requests. hint hint.


And please send me all bug reports and or changes you may make or want,
so that others can benefit from them as well.
