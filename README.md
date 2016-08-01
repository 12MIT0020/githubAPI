# githubAPI
issue calculator

This project can calculate the open issues

Input : User can input a link to any public GitHub repository

Output :

Your UI should display a table with the following information -

- Total number of open issues

- Number of open issues that were opened in the last 24 hours

- Number of open issues that were opened more than 24 hours ago but less than 7 days ago

- Number of open issues that were opened more than 7 days ago 
- 

Input :
Input url is of specified format will work.Because it is according to git hub devloper API
For Example 
https://github.com/Shippable/support/issues will not work.
we have to give https://api.github.com/Shippable/support/issues

https://github.com/twbs/bootstrap/issues will not work.
we have to give https://api.github.com/repos/twbs/bootstrap/issues

For getting result per page
https://api.github.com/Shippable/support/issues?per_page=100

maximum 100 page git hub allow.



