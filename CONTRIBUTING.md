Contributing to a PHP.Gt repository
===================================

🙌 🎉 Firstly, **thank you!** 🎉 🙌 If you're reading this, you're probably interested in contributing to a PHP.Gt repository in some way. Thank you for showing interest and taking the time to read this document.

All PHP.Gt repositories are community-driven projects. Your participation in the growth and development of the projects is highly welcomed. We strive to be as inclusive as possible.

What do you need to know before you get started?
------------------------------------------------

Code within the PHP.Gt organisation is split over different repositories. The first thing to know is how the respositories are broken up and where your issue/idea/bug/feature/question is for.

[WebEngine](https://php.gt/webengine) is the main project that is used to build web applications, and depends on all other PHP.Gt repositories. Core responsibilities of this project include the `gt` commands, web routing, the request/response lifecycle, Page Logic classes and the "go" functions.

You may want to contribute on the components that make up the WebEngine. The main components include:

+ [Dom](https://php.gt/dom) - The wrapper to PHP's DOMDocument, allowing modern DOM usage within PHP.
+ [DomTemplate](https://php.gt/domtemplate) - An extension to Php.Gt/Dom providing data binding, templates and custom elements.
+ [Input](https://php.gt/input) - The replacement to $_GET, $_POST and $_FILES superglobals.
+ [Database](https://php.gt/database) - How WebEngine applications organise and execute SQL queries.

There are many other repositories that make up the WebEngine, which you can see at [github.com/PhpGt](https://github.com/PhpGt). It is very helpful to understand where the areas of responsibility lie within WebEngine before contributing.

Ways you can help
-----------------

### Identify a bug and submit an issue

Have you found a defect with a piece of functionality? Bugs are tracked as [Github issues](https://help.github.com/articles/about-issues/). After you've determined [which repository](#what-do-you-need-to-know-before-you-get-started) your bug is related to, create an issue within that Github repository that explains the problem. Include as much details as possible that will help maintainers reproduce the problem:

+ Search the existing list of issues for a related issue.
+ Use a clear and descriptive issue title.
+ Describe the exact steps that reproduce the problem. Add detail of _how_ and _why_ you were doing what you were doing that caused the issue.
+ Where possible, provide code snippets that demonstrate the steps you took to identify the issue.
+ Explain the behaviour you _expected_ to see, versus what you _actually_ saw.
+ Include screenshots where necessary.

Answers to the following questions are very helpful to include within the issue:

+ What operating system are you running?
+ What version of PHP are you running?
+ If there is a webserver involved (Apache, Nginx, etc.), what version?
+ How is PHP running on your computer - is it within a virtual machine, container or native?
+ Does changing versions of the repository/repositories affect the issue? You can specify different versions of dependencies in the composer.json file of your project.

### Suggesting new ideas and enhancements

We welcome all new ideas and enhancements. If you think something is a good idea, chances are others will too.

+ Use a clear and descriptive enhancement title.
+ Provide examples of how the enhancement could work using code/screenshots.
+ Explain why this enhancement will be useful.
+ If other software has the enhancement you are requesting, list out how to use it in the other software.

### Contribute code

If you are looking for a project to contribute to, we promote the use of "good first issue" and "help wanted" issues. Issues tagged with these labels are purposefully left open for new contributors to find and tackle. If you leave a comment on the issue that you would like to help with, but are not sure how to get started, a core contributor will happily mentor you towards your first contribution.

"Good first" is assigned to issues that are more simplistic and have a tightly focused scope. These issues are intended to be accessible to new contributors to the repositories, or even new coders in general.

"Help wanted" is assigned to issues that are well defined, are not too complex, and have an obvious scope. These issues are intended to be accessible to coders who are familiar with the process of submitting pull requests, but help is still available where needed.

+ [Good first issues within PHP.Gt][good-first-issues]
+ [Help wanted issues within PHP.Gt][help-wanted-issues]

**It is the main priority of the PHP.Gt organisation to be as inclusive as possible and help everyone contribute code**. Our pledge is to provide mentorship to anyone who shows an interest on an issue labelled "good first issue", as the most important thing to the organisation is a thriving, inclusive community.

#### How to make a change to the code

Once you've identified what you want to contribute to, the process of making a change to the code and updating the repository is as follows:

1. [Fork the repository](https://help.github.com/articles/fork-a-repo/) so you own a copy of it.
1. [Clone your forked repository](https://help.github.com/articles/cloning-a-repository/) to your computer.
2. Preferably, write a unit test to cover your contribution.
3. Make the changes to the code.
4. [Commit and push](https://help.github.com/articles/adding-a-file-to-a-repository-using-the-command-line/) your changes back to your forked repository.
5. [Submit a pull request](https://help.github.com/articles/creating-a-pull-request/) to the original repository at PHP.Gt.

#### Submitting a pull request (PR)

Assuming you have made a fork of a PHP.Gt repository, and pushed your changes to the fork:

1. On Github, go to your forked repository.
2. Using the branch selection menu, select the branch that your changes are on.
3. Click "New pull request" next to the branch selection menu.
4. Describe the changes you have made and how it works.
5. Explain how the contributors can test them, and what unit tests that are in place.
6. [Tag any issues](https://blog.github.com/2013-05-14-closing-issues-via-pull-requests/) the PR covers.

Creating a PR will allow contributors to discuss the changes, review the code and suggest edits. It's best practice to try and complete the coding before creating a PR, but if you need help finishing the coding or writing tests, feel free to create an unfinished PR and explain that in the PR message.

### Improve documentation

Documentation for all PHP.Gt repositories is stored in each repository's Github Wiki, which is used to populate the website at www.php.gt .

As with all wikis, the wiki is open to edit by any registered Github user. Changes will be reviewed for quality over time, but there is no formal pull request process in place to make changes to the wiki.

### Financial contributions

PHP.Gt is open source and free, and always will be. If you feel like supporting the development of PHP.Gt financially, [please pledge a monthly donation via Patreon](https://www.patreon.com/phpgt).

Coding style guide
------------------

A guide (not a rulebook) is available at https://php.gt/styleguide, which allows for developers to code in a consistent style across all repositories. It is recommended to adhere to the style guide when creating pull requests.

Test driven development (TDD)
-----------------------------

TDD is a programming methodology where the developer writes the tests for their code before the code itself is written. [Read about TDD on Wikipedia](https://en.wikipedia.org/wiki/Test-driven_development). It should not be seen as a holy grail of software development, but it is useful practice.

All repositories within PHP.Gt aim to maintain tests that cover 100% of the codebase. Again, this should not be seen as a method of writing perfect code, but it too is useful practice.

When contributing to PHP.Gt, please be conscious of the tests coverage you are affecting, and aim to write tests that cover any functionality you contribute to. Feel free to ask for help writing tests in the issue tracker and a contributor will do their best in assisting you.

[good-first-issues]: https://github.com/search?l=&q=org%3Aphpgt+type%3Aissue+is%3Aopen+label%3A%22good+first+issue%22&ref=advsearch&type=Issues&utf8=%E2%9C%93
[help-wanted-issues]: https://github.com/search?l=&q=org%3Aphpgt+type%3Aissue+is%3Aopen+label%3A%22help-wanted%22&ref=advsearch&type=Issues&utf8=%E2%9C%93
