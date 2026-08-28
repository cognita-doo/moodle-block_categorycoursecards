# Category Course Cards

Category Course Cards is a Moodle block that displays standard Moodle course cards from one or more selected course categories.

The block can be added to the Site home or Dashboard. Each block instance can use its own category selection, title, sub-category behaviour, and number of course cards displayed per page.

## Features

- Select one or more course categories.
- Optionally include courses from sub-categories.
- Display courses using Moodle's standard course-card renderer.
- Set a custom block title or let the block generate one from the selected categories.
- Configure the number of course cards per page from 1 to 36; the default is 12.
- Use multiple independent instances of the block on the same page.
- Paginate course cards independently for each block instance.

## Requirements

- Moodle 4.5 or later is required by `version.php`.

The initial release is being validated on supported Moodle branches before an explicit compatibility range is declared.

## Installation

Install the plugin using Moodle's standard plugin installation process, or copy the `categorycoursecards` directory to:

`blocks/categorycoursecards`

Then visit **Site administration > Notifications** to complete the installation.

## Configuration

After adding the block, open its configuration and set:

- **Block title** — optional custom title.
- **Course categories** — one or more categories whose courses should be displayed.
- **Include sub-categories** — include courses from descendants of the selected categories.
- **Courses per page** — number of course cards shown on one page of the block, from 1 to 36.

If no custom title is entered, the block generates a title from the selected category names.

## Privacy

This plugin does not store personal user data. It only displays course information already available in Moodle.

## Project links

- Source code: https://github.com/cognita-doo/moodle-block_categorycoursecards
- Issue tracker: https://github.com/cognita-doo/moodle-block_categorycoursecards/issues

## License

This plugin is licensed under the GNU GPL v3 or later.
