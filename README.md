# Hannah's Mentoring

## Branching Workflow

1. Branches should be made from the `master` branched and named with the issue number followed be a description of the feature you are adding. e.g. `3-add-branching-workflow`.
1. Pull Requests should be made early and they should include `WIP`, `work in progress` or 🚧 in the title.
1. Once a Pull Request is ready for code review then `WIP`, `work in progress` or 🚧 should be removed from the title then assigned to someone for code review.
1. The description of the issue should reference the issue it is closing. e.g. `Fixes #3`.
1. The person will code review and leave inline comments were applicable. Once completed the Pull Request will either be submitted back to the author of the PR or merged if there are no changes required.

## Setup

1. Clone Chassis into a new folder: `git clone https://github.com/Chassis/Chassis.git hannah`.
1. Change into the newly cloned folder: `cd hannah`.
1. Clone this repo into a content folder: `git clone https://github.com/BronsonQuick/Hannah.git content`.
1. Copy `local-config-sample.php` and rename it to `local-config.php`. Use this file to define and PHP constants you need for the project.
1. Run Vagrant `vagrant up`.
1. Visit [http://adora.local](http://adora.local) to see the frontend of the site.
1. Login to the [admin](http://adora.local/wp/wp-admin) using username: `admin` and password: `password`.
1. Profit!

## Xdebug

Xdebug will be automatically setup for [PHPStorm](https://github.com/Chassis/Xdebug#in-phpstorm). You can follow these [instructions](https://github.com/Chassis/Xdebug#browser-setup) to config everything.

## MailHog

Mailhog has been automatically setup for you to capture all your WordPress email. Visit [http://adora.local:8025](http://adora.local:8025) to view any email sent via WordPress.

## SequelPro

We have installed the [SequelPro](https://sequelpro.com/) extension for Chassis. We recommend you download and install the [SequelPro test build](https://sequelpro.com/test-builds).

To connect to the WordPress database simply run `vagrant sequel`.

## phpMyAdmin

We've automatically installed and setup phpMyAdmin for you. You can visit it [here](http://adora.local/phpmyadmin).
