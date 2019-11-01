![WorkflowyPHP](logo.png)

# RK's Public Code

Useful code bits I made for my needs! Download and grab the piece you need. It's far more likely I'll update and maintain this if it's all in one repository versus 57 little repositories all scattered about. (Though certain things that might really deserve their own repository, for various reasons, may remain in my public profile as well.)


---
* [Disclaimer](#dislaimer)
* [File "Outputters" in PHP](#outputters)
  * [text files to table](#login-api)
  * [text files to xml](#lists-api)
    * [tag creation](#get-the-informations-of-a-list)
  * [excel to xml](#lists-api)  
  * [files to wordpress xml](#lists-api)
* [Google Sheets](#changelog)
* [Simplenote](#simplenote)
* [Bear Notes](#bearnote)
* [Apples Notes to Evernote (Applescript)](#applenotes)
* [Workflowy](#workflowy)
* [Asana](#asana)
* [CSS Stuff](#css)
	* [Tailwind Global Config](#tailwind)
* [Design Stuff](#design)	
	* [Image Explainers (17_04_14)](#explainers)
* [Credits](#credits)


## Disclaimer

These are just things I that I made to move data around or achieve some end. There may be better ways to do these things but these represent the solutions that worked for me and I'm happy to share to help out others. 

Hosting all this stuff on Github publicly also, selfishly, forces me to document what I did so I better remember it when I have to use these little pieces of code in the future! 

## Workflowy

Retrieve all your notes from Workflowy using PHP as an array then format them however you wish. This uses an older version of @johansatge unofficial WorkFlowy API. An updated version of this is here: https://github.com/johansatge/workflowy-php

### How? 

Just add your Workflowy login and password to the top of the index.php file and you're good to go. I output the data in a textarea in the event you want to format the output in XML.  

```php

$session_id = WorkFlowy::login('email@gmail.com', 'password');

```

If you do not use Composer, you can download the source files, install it anywhere on your project, and call the providden autoloader file:

```php
<?php require_once '/your/project/root/path/workflowy-php/src/autoload.php';
```

## Usage

### Login API

Because of the unofficial status of the API, you have to login first, by using your regular credentials, before being able to perform requests on your data.

```php
use WorkFlowyPHP\WorkFlowy;
use WorkFlowyPHP\WorkFlowyException;
try
{
    $session_id = WorkFlowy::login('user@domain.org', 'password');
}
catch (WorkFlowyException $e)
{
    var_dump($e->getMessage());
}
```

The `$session_id` variable will be used later, when performing requests.

You have to use your unencoded password in your code. 
So I strongly advise you to store it in a different file, or ask it once to the user, then store the session ID. (But keep in mind that the session does not last forever.)
This is a huge limitation, but for now there is no workaround.

### Lists API

Lists-related stuff is managed with the recursive `WorkFlowySublist` class.

First, you will need to get the main (root) list.

```php
use WorkFlowyPHP\WorkFlowyList;

$list_request = new WorkFlowyList($session_id);
$list = $list_request->getList();
```

Then, you will be able to perform the following operations on the resulting `$list`, or its sublists.

#### Get the informations of a list

| Function | Returns | Description |
| --- | --- | --- |
| `$list->getID();` | `string` | Get the ID of the list |
| `$list->getName();` | `string` | Get the name of the list |
| `$list->getDescription();` | `string` | Get the description of the list |
| `$list->getParent();` | `WorkFlowySublist` | Get the parent of the list |
| `$list->isComplete();` | `boolean` | Get the status of the list |
| `$list->getOPML();` | `string` | Get the list and its sublists as an OPML string |
| `$list->getSublists();` | `string` | Get the sublists of the list |
| `$list->searchSublist('/My sublist name/');` | `WorkFlowySublist` | Returns the first child list matching the given name |
| `$list->searchSublist('/My sublist name/', array('get_all' => true));` | `array` | Returns all children lists matching the given name |

#### Edit the informations of a list

| Function | Parameters | Description |
| --- | --- | --- |
| `$list->setName('My sublist');` | `string` | Sets the list name |
| `$list->setDescription('My sublist description');` | `string` | Sets the list description |
| `$list->setParent($parent_list, 2);` | `WorkFlowySublist`,`int` | Sets the list parent and its position |
| `$list->setComplete(true);` | `boolean` | Sets the list status |
| `$list->createSublist('My sublist name', 'My sublist description', 9);` | `string`,`string`,`int` | Creates a sublist |

The methods below are used to edit data.

Keep in mind that they will send requests to the server, but not update the existing variables.

For instance, if you change the parent of a list and call the getSublists() method on its old parent, the list will still be present in the resulting array.

### Account API

| Function | Returns | Description |
| --- | --- | --- |
| `$account_request = new WorkFlowyAccount($session_id);` | `WorkFlowyAccount` | Gets an account object |
| `$account_request->getUsername();` | `string` | Gets his username |
| `$account_request->getEmail();` | `string` | Gets his email address |
| `$account_request->getEmail();` | `string` | Gets his registration date |
| `$account_request->getTheme();` | `string` | Gets his selected theme |
| `$account_request->getItemsCreatedInMmonth();` | `int` | Gets the number of items created during the month |
| `$account_request->getMonthlyQuota();` | `int` | Gets his monthly quota |
| `$account_request->getRegistrationDate('d-m-Y');` | `string` | Gets his registration date<br>Leave the format empty to use the default value ('Y-m-d H:i:s')<br> Give the 'timestamp' value to get the timestamp instead of a date. |

## Changelog

| Version | Date | Notes |
| --- | --- | --- |
| `0.1.2` | 2016-06-26 | Fix `searchSublist`with `get_all` option ([@hirechrismeyers](https://github.com/hirechrismeyers)) |
| `0.1.1` | 2015-08-25 | Fix case of filenames ([@citywill](https://github.com/citywill)) |
| `0.1` | 2015-01-01 | Initial version |

## Credits

* [WorkFlowy](http://workflowy.com)
