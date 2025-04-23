# Final Project Proposal (itemized)

## Jade Lilian

Project plan: Create a webcomic hosting site that allows an artist to routinely upload new pages of their comic, allows users to comment on each page, and includes a self-updating archive of the entire posted comic to date.

### Priority backlog:

1. ~~Base layout page. Includes image from assets by GET request, corresponding blog post, skeletal menu page. Modify archive links to submit chapter and page number by url searchParam instead~~
2. ~~Base archive page, with a dropdown with every page option listed, and a list-style visual below that organizes by the first page of each subsection (e.g. book, chapter, etc).~~
3. User login and signup pages (integrate from wk9 hw).
4. Admin new page upload.
5. Page comments (single-layer)
6. Cursor tracking
---
7. Cookies to preserve user sessions continuously through page navigation
8. Button scaling, styling, theming. General QoL stuff.
9. Live comment updating support (through AJAX or possibly fetch)
10. User data tracks last-marked page. Index page automatically reroutes to last-bookmarked.
11. Implement artist page-post data
12. Learn PHP OOP
13. Nested comments (reply to other user comments, reply to those). Requires a tree structure where a comment `has_a id`, `has_a user`, `has_a content`, `has_a timestamp`, `has_many comments`.
14. Users can edit/delete their comments (will mark with an `EDITED` flag or replace content with `DELETED` and freeze content, appropriate to the action taken).

### Directly matching to the same number item from the project requirements:

1. HTML/CSS for styling, PHP for, like, everything (layouts, user data, etc. Past weeks have demonstrated my ability to use php to program webpages), JS for login/signup (AJAX for signin validation) and commenting features.
2. Admin upload images with blog post and tags for new pages. Use .json files to store user data and comment data.
3. Clearly this project comes with a theme.
4. Users have the ability to comment on new pages. Admin can upload new pages to the site.
5. User comments stored.
6. Comments update periodically from the server. 
7. Archive page generated based on uploaded pages for a fully updated archive of the entire site's pages
8. Session signins (cookies). Image file uploading (as opposed to simple read/writing). Hover dropdown for nav bar.
9. Implicit
10. Considering having hover actions such as scaling up buttons when hovered over. Also considering a page turn on hover, and an accessibility feature where a colored transparent highlighter trails the cursor to help process text and focus vision (I find I am frequently desiring this feature when I visit sites. If I include it, there will be an option to disable it).
11. Signin and commenting both communicate with the server. Possible light/dark modes. Aforementioned default-hidden menu... likely more than one of those, but any would fill this requirement
12. One-student project. Requirement will be included in final submission.
13. Again, it will be or it will not. Requirement will be included in final submission.
14. Will do o7
15. What happens if I'm sick and unable to come into class? I am disabled and managed to lose my cane, so I might genuinely not be able to come all the way here, or possibly be unable to bring my computer...?
16. o7
17. I'd be amazed if I submit something that flat-out does not work. Anything I submit will at the very least load pages on my end and include an intuitive navigation UI

# Final Project Proposal (old)

## Jade Lilian

Create fully functioning webcomic hosting site a la [Tiger, Tiger](https://www.tigertigercomic.com/).

- users featuring commenting on pages
- admin featuring comment moderation, new page uploads (and/or blog posts?) via form
- possibly add live comment updating via AJAX with a js interval?
- (file upload)[https://www.w3schools.com/php/php_file_upload.asp] for gui to add new pages
- (cookies)[https://www.w3schools.com/php/php_cookies.asp] for remembering login and site settings (a la dark mode?)

