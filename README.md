# Gravity Forms Entry Count

This is a relatively simple plugin that does two things:
* Allows you to show the number of entries for a form on the frontend of the site
* Allows you to set a goal and display a progress bar for entries (you could use this for donations)

There are a few other features:
* You can preset the "start" number of entries (no one starts a tip jar completely empty)
* If the form is submitted via ajax, the entry number will update at the same time.
 
## Usage

There are two shortcode we'll be using, one for pulling in the number and one for displaying a progress bar.

### Displaying the number of entries

Display the number of entries for a form with a form ID of 1, adding 25 to the number of submissions:

```
[formcount formid=1 startnumber=25]
```

### Displaying the goal bar

Display a goal bar for a form with a form ID of 1, adding 25 to the number of submissions and setting a goal of 100 submissions:

```
[goalcount formid=1 startnumber=25 goalnumber=100]
```
